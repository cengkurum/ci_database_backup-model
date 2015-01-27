<?php
/**
 * Created by PhpStorm.
 * User: cengkuru
 * Date: 1/27/2015
 * Time: 9:00 AM
 *
 * Codeigniter specific
 * Handy model you can autoload to automatically back up your entire database
 * Its at its most basic level doing backups every monday
 * you can add savvy features like self email of the backup
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Db_backup_m extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        $this->run_backup();


    }


    function run_backup ()
    {

        //back up on mondays
        if(date('l')=='Monday')
        {
            // Load the DB utility class
            $this->load->dbutil();

            // Backup your entire database and assign it to a variable
            $backup =& $this->dbutil->backup();

            // Load the file helper and write the file to your server
            $this->load->helper('file');

            //create a folder in the root and call it backups
            write_file('./backups/mybackup.gz', $backup);

            // Load the download helper and send the file to your desktop
            $this->load->helper('download');
            force_download('mybackup.gz', $backup);

        }



    }

}