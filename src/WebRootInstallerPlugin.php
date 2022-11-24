<?php

namespace Cloudrly\Composer\WebRoot;

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

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // Not needed
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // Not needed
    }
}