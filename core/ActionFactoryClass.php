<?php

class ActionFactory
{
    private static $instance = null;

    private $mapping = array(
        'g' => 'GeneratorAction',
        'db:load' => 'DBLoaderAction',
        'db:create' => 'DBCreatorAction',
        'db:migrate' => 'DBMigratorAction',
        'db:rollback' => 'DBMigratorRollbackAction',
        'task' => 'TaskRunnerAction',
    );

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ActionFactory();
        }

        return self::$instance;
    }

    public function getAction($action_code)
    {
        if (isset($this->mapping[$action_code])) {
            return new $this->mapping[$action_code]();
        }

        throw new Exception("Invalid action - {$action_code}");
    }
}
