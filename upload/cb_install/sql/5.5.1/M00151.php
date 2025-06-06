<?php
namespace V5_5_1;
require_once \DirPath::get('classes') . 'migration' . DIRECTORY_SEPARATOR . 'migration.class.php';

class M00151 extends \Migration
{
    /**
     * @throws \Exception
     */
    public function start()
    {
        self::alterTable('ALTER TABLE ' . tbl('sessions') . ' ADD INDEX(`session_date`);', [
            'table'  => 'sessions',
            'column' => 'session_date'
        ]);
    }
}
