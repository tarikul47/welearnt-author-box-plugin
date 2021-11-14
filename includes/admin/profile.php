<?php
function welearnt_user_contact_methods($profile_fields)
{

    $profile_fields['twitter'] = 'Twitter URL';
    $profile_fields['facebook'] = 'Facebook URL';
    $profile_fields['linkedin'] = 'Linkedin URL';
    $profile_fields['github'] = 'GitHub URL';
    return $profile_fields;
}
add_filter('user_contactmethods', 'welearnt_user_contact_methods');
