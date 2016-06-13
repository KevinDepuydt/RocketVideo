<?php
/**
 * Created by PhpStorm.
 * User: KevinSup
 * Date: 31/05/2016
 * Time: 23:12
 */

namespace AppBundle\Command;

use AppBundle\Entity\Stream;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RetrieveVideoCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('video:retrieve')
            ->setDescription('Retrieve video from website url')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $stream = $this->getContainer()->get('app.entity.stream');
        $streamToDl = $stream->findOneByState(Stream::STREAM_NOT_DOWNLOADED);

        if ($streamToDl) {
            // a stream to download was found
            $output->writeln("*** <info>Stream to download found</info> ***");

            // get entity manager
            $em = $this->getContainer()->get('doctrine')->getManager();

            // filename
            $filename = $streamToDl->getName().".mp4";

            // create process
            $process = new Process('youtube-dl -o '."web/downloads/".$filename.' '.$streamToDl->getPath());

            $process->setTimeout(0);

            // set stream as started download
            $streamToDl->setState(Stream::STREAM_DOWNLOAD_PROCESSING);

            // refresh
            $em->flush();

            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo 'Error -> '.$buffer;
                } else {
                    echo $buffer;
                }
            });

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            } else {
                $streamToDl->setPath($filename);
                $streamToDl->setState(Stream::STREAM_DOWNLOADED);
                $em->flush();

                if (!$streamToDl->isPublic()) {

                    $user = $this->getContainer()->get('app.entity.user')->findOneById($streamToDl->getUser()->getId());

                    // send validation message
                    $message = \Swift_Message::newInstance()
                        ->setSubject('Votre vidéo est disponible')
                        ->setFrom(['rocketvideosup@gmail.com' => "RocketVideo"])
                        ->setTo([$user->getEmail() => $user->getUsername()])
                        ->setContentType('text/html')
                        ->setBody(
                            $this->getContainer()->get('templating')->render(
                                'AppBundle:Emails:video_downloaded.html.twig',
                                array('stream_id' => $streamToDl->getId(), 'base_url_mail' => $this->getContainer()->getParameter('base_url_mail'))
                            )
                        )
                    ;
                    $this->getContainer()->get('mailer')->send($message);
                }

                $output->writeln("*** <info>Download successful</info> ***");
            }

        } else {
            $output->writeln("*** <error>No Stream to download found</error> ***");
        }
    }
}