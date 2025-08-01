<?php

declare(strict_types=1);

namespace App;

use Nette;
use Nette\Bootstrap\Configurator;
use Symfony\Component\Dotenv\Dotenv;

class Bootstrap
{
	private Configurator $configurator;
	private string $rootDir;


	public function __construct()
	{
		$this->rootDir = dirname(__DIR__);
		$this->configurator = new Configurator();
		$this->configurator->setTempDirectory($this->rootDir . '/temp');
	}


	public function bootWebApplication(): Nette\DI\Container
	{
		$this->initializeEnvironment();
		$this->setupContainer();
		return $this->configurator->createContainer();
	}


	public function initializeEnvironment(): void
	{
		$dotenv = new Dotenv();
		$dotenv->load($this->rootDir . '/.env');

		$this->configurator->setDebugMode(true); // enable for your remote IP
		$this->configurator->enableTracy($this->rootDir . '/log');
		$this->configurator->setTimeZone('Europe/Prague');
		$this->configurator->addDynamicParameters([
			'env' => $_ENV,
		]);

		$this->configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();
	}


	private function setupContainer(): void
	{
		$configDir = $this->rootDir . '/config';
		$this->configurator->addConfig($configDir . '/common.neon');
		$this->configurator->addConfig($configDir . '/services.neon');
	}
}
