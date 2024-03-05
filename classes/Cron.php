<?php
/**
 * Class of Cronjobs
 */

final class Cron 
{   
    /**
     * Daily Reporting of validated registrations
     */
    public static function reporting()
    {
        $date = date('Y-m-d', strtotime('-3 days'));
        $today = date('Y-m-d');                

        $registrations = DB::getData('applicant', " status = 2 AND reg_date >= '$date' ORDER BY selected_date ASC ");

        if(count($registrations) > 0) {
            $file = fopen("docs/reports/{$today}_nyilt_nap.txt", "w") or die();

            foreach($registrations as $reg) {
                $reg_data = "{$reg['name']} {$reg['email']} {$reg['selected_date']}\n";
                fwrite($file, $reg_data);
                
                DB::updateData('applicant', $reg['id'], 3);                 
            }
            fclose($file);

            $saved_file = array_diff(scandir('docs/reports'), ['.', '..']);

            if(count($saved_file) > 0) {
                $send_report = Email::SendReport('dunakeszijitsu@gmail.com', 'Megyeri József', "docs/reports/{$today}_nyilt_nap.txt");               

                if($send_report) {
                    unlink("docs/reports/{$today}_nyilt_nap.txt");
                }
            }
        }
    }
}
