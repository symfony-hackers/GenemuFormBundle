<?php

namespace SymfonyHackers\Bundle\FormBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use SymfonyHackers\Bundle\FormBundle\Gd\File\Image;

class ImageController implements ContainerAwareInterface
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

    public function changeAction(Request $request)
    {
        $rootDir = rtrim($this->container->getParameter('genemu.form.file.root_dir'), '/\\') . DIRECTORY_SEPARATOR;
        $folder = rtrim($this->container->getParameter('genemu.form.file.folder'), '/\\');

        $file = $request->get('image');
        $handle = new Image($rootDir . $this->stripQueryString($file));

        switch ($request->get('filter')) {
            case 'rotate':
                $handle->addFilterRotate(90);

                break;
            case 'negative':
                $handle->addFilterNegative();

                break;
            case 'bw':
                $handle->addFilterBw();

                break;
            case 'sepia':
                $handle->addFilterSepia('#C68039');

                break;
            case 'crop':
                $x = $request->get('x');
                $y = $request->get('y');
                $w = $request->get('w');
                $h = $request->get('h');

                $handle->addFilterCrop($x, $y, $w, $h);

                break;
            case 'blur':
                $handle->addFilterBlur();

            default:
                break;
        }

        $handle->save();
        $thumbnail = $handle;

        if ($this->container->hasParameter('genemu.form.image.thumbnails')) {
            $thumbnails = $this->container->getParameter('genemu.form.image.thumbnails');

            foreach ($thumbnails as $name => $thumbnail) {
                $handle->createThumbnail($name, $thumbnail[0], $thumbnail[1]);
            }

            $selected = key(reset($thumbnails));
            if ($this->container->hasParameter('genemu.form.image.selected')) {
                $selected = $this->container->getParameter('genemu.form.image.selected');
            }

            $thumbnail = $handle->getThumbnail($selected);
        }

        $json = array(
            'result' => '1',
            'file' => $folder . '/' . $handle->getFilename() . '?' . time(),
            'thumbnail' => array(
                'file' => $folder . '/' . $thumbnail->getFilename() . '?' . time(),
                'width' => $thumbnail->getWidth(),
                'height' => $thumbnail->getHeight()
            ),
            'image' => array(
                'width' => $handle->getWidth(),
                'height' => $handle->getHeight()
            )
        );

        return new JsonResponse($json);
    }

    /**
     * Delete info after `?`
     *
     * @param string $file
     *
     * @return string
     */
    private function stripQueryString($file)
    {
        if (false !== ($pos = strpos($file, '?'))) {
            $file = substr($file, 0, $pos);
        }

        return $file;
    }
}
