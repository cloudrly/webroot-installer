<?php

namespace cloudrly\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class TemplateInstaller extends LibraryInstaller
{

    const INSTALLER_TYPE = 'webroot';

    /**
     * @inheritDoc
     */
    public function getInstallPath(PackageInterface $package)
    {
        $type = $package->getType();
        
        $prettyName = $package->getPrettyName();
        if (strpos($prettyName, '/') !== false) {
            list($vendor, $name) = explode('/', $prettyName);
        } else {
            $vendor = '';
            $name = $prettyName;
        }
        
        if ($this->composer->getPackage()) {
            $extra = $this->composer->getPackage()->getExtra();
            
            if (!empty($extra['webroot-dir']) &&
                !empty($extra['webroot-package']) &&
                $extra['webroot-package'] === $prettyName) {
                return $extra['webroot-dir'];
            } else {
                throw new \InvalidArgumentException('Only one package can be installed into the configured webroot.');
            }
        } else {
            throw new \InvalidArgumentException('The root package is not configured properly.');
        }
    }

    /**
     * @inheritDoc
     */
    public function supports($packageType)
    {
        return self::INSTALLER_TYPE === $packageType;
    }
}