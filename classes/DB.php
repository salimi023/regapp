<?php
/**
 * Database class
 */
final class DB 
{        
    /**
     * Connect to database
     */    
    public function __construct()
    {
        R::setup('mysql:host=' . $_SERVER['DB_HOST'] . ';dbname=' . $_SERVER['DB_NAME'], $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);        
    }
    
    /**
     * Saving Data
     * 
     * @param array $data
     * @return boolean
     */    
    public static function saveData($table, $data = [])
    {
        $applicant = R::dispense($table);

        foreach($data as $column => $value) {
            $applicant[$column] = $value;            
        }

        $save = R::store($applicant);       
        $result = $save ? $save : false;

        return $result;
    }

    /**
     * Get Applicant by Email
     * 
     * @param integer $applicant_id
     * @return boolean
     */
    public static function getApplicantByEmail($table, $email)
    {
        $applicant = R::find($table, ' email = ? ', [$email]);
        
        if(count($applicant) == 0) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    /**
     * Get Data
     * 
     * @param string $table
     * @param string $sql
     * 
     * @return array
     */
    public static function getData($table, $sql = false)
    {
        return R::findAll($table, $sql);
    }

    /**
     * Update Data
     * 
     * @param integer $applicant_id
     */
    public static function updateData($table, $applicant_id, $value = false)
    {
        $applicant = R::load($table, $applicant_id);              
        $applicant->status = $value ? $value : 2;
        $update = R::store($applicant);
        
        return $update;
    } 
    
    /**
     * Delete Data
     * 
     * @param integer $applicant_id
     */
    public static function deleteData($table, $applicant_id)
    {
        $applicant = R::load($table, $applicant_id);
        $delete = R::trash($applicant);

        return $delete;
    }
}