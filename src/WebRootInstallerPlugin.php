<?php

namespace Cloudrly\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class WebRootInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new WebRootInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}