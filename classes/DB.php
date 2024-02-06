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
    public static function saveData($data = [])
    {
        $applicant = R::dispense('applicant');

        foreach($data as $column => $value) {
            $applicant[$column] = $value;            
        }

        $save = R::store($applicant);       
        $result = $save ? $save : false;

        return $result;
    }

    /**
     * Get Data
     * 
     * @param integer $applicant_id
     * @return boolean
     */
    public static function getApplicantByEmail($email)
    {
        $applicant = R::find('applicant', ' email = ? ', [$email]);

        // var_dump($applicant);

        if(count($applicant) == 0) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    /**
     * Update Data
     * 
     * @param integer $applicant_id
     */
    public static function updateData($applicant_id)
    {
        $table = R::dispense('applicant');
        $applicant = R::load($applicant_id);
        $applicant['status'] = 2;
        $update = R::store('applicant');
        
        return $update;
    } 
    
    /**
     * Delete Data
     * 
     * @param integer $applicant_id
     */
    public static function deleteData($applicant_id)
    {
        $table = R::dispense('applicant');        
        $applicant = R::load($table, $applicant_id);
        R::trash($applicant);
    }
}