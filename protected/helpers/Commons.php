<?php
/**
 * Created by JetBrains PhpStorm.
 * User: FFK-PC
 * Date: 7/14/13
 * Time: 7:15 PM
 * To change this template use File | Settings | File Templates.
 */

class Commons {
    public static function buildEmailContent($template_id, $dataarray, &$subject)
    {
        $content = Emailtemplates::model()->find("id=:id", array(":id" => $template_id));
        $emailTemplate = html_entity_decode($content->email_content);
        $subject = $content->subject;
        if (!empty($content) && is_array($dataarray))
        {
            foreach ( $dataarray as $key => $value ) {
                $subject = str_replace("{" . strtoupper($key) . "}", $value, $subject);
            }

            foreach ( $dataarray as $key => $value ) {
                $emailTemplate = str_replace("{" . strtoupper($key) . "}", $value, $emailTemplate);
            }
        }
        return $emailTemplate;
    }
}