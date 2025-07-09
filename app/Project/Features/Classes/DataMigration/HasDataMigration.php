<?php

namespace App\Project\Features\Classes\DataMigration;

use DB;
use Symfony\Component\Console\Output\ConsoleOutput;

trait HasDataMigration
{
    /** @var \Symfony\Component\Console\Output\ConsoleOutput */
    public $console;

    /** @var int */
    public $chunk; // Number of rows to process in one chunk

    public $oldDBConnection = 'mysql_old_database'; // Initialize

    public function initProgress()
    {
        $this->console = $this->console ?: new ConsoleOutput();
        $this->chunk = $this->chunk ?: 100;

    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function newDB()
    {
        return DB::connection('mysql');
    }

    /**
     * @return \Illuminate\Database\Connection
     */
    public function oldDB()
    {
        return DB::connection($this->oldDBConnection);
    }

    /**
     * @param $table
     * @return \Illuminate\Database\Query\Builder
     */
    public function newTable($table)
    {
        return (new self())->newDB()->table($table);
    }

    /**
     * @param $table
     * @return \Illuminate\Database\Query\Builder
     */
    public function oldTable($table)
    {
        return (new self())->oldDB()->table($table);
    }

    /**
     * @param $msg
     * @return void
     */
    public function output($msg)
    {
        $this->console->writeln($msg);
    }
}
