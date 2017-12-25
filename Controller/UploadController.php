<?php

namespace SymfonyHackers\Bundle\FormBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use SymfonyHackers\Bundle\FormBundle\Gd\File\Image;

class UploadController implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function uploadAction(Request $request)
    {
        $handle = $request->files->get('Filedata');

        $folder = $this->container->getParameter('genemu.form.file.folder');
        $uploadDir = $this->container->getParameter('genemu.form.file.upload_dir');
        $name = uniqid() . '.' . $handle->guessExtension();

        $json = array();
        if ($handle = $handle->move($uploadDir, $name)) {
            $json = array(
                'result' => '1',
                'thumbnail' => array(),
                'image' => array(),
                'file' => ''
            );

            if (preg_match('/image/', $handle->getMimeType())) {
                $handle = new Image($handle->getPathname());
                $thumbnail = $handle;

                if ($this->container->hasParameter('genemu.form.image.thumbnails')) {
                    $thumbnails = $this->container->getParameter('genemu.form.image.thumbnails');

                    foreach ($thumbnails as $name => $thumbnail) {
                        $handle->createThumbnail($name, $thumbnail[0], $thumbnail[1]);
                    }

                    if (0 < count($thumbnails)) {
                        $selected = key(reset($thumbnails));
                        if ($this->container->hasParameter('genemu.form.image.selected')) {
                            $selected = $this->container->getParameter('genemu.form.image.selected');
                        }

                        $thumbnail = $handle->getThumbnail($selected);
                    }
                }

                $json = array_replace($json, array(
                    'thumbnail' => array(
                        'file' => $folder . '/' . $thumbnail->getFilename() . '?' . time(),
                        'width' => $thumbnail->getWidth(),
                        'height' => $thumbnail->getHeight()
                    ),
                    'image' => array(
                        'width' => $handle->getWidth(),
                        'height' => $handle->getHeight()
                    )
                ));
            }

            $json['file'] = $folder . '/' . $handle->getFilename() . '?' . time();
        } else {
            $json['result'] = '0';
        }

        return new JsonResponse($json);
    }
}
