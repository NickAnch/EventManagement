<?php
return array(
    'meetings/([0-9]+)' => 'meetings/view/$1',
    'meetings/page-([0-9]+)' => 'meetings/index/$1',
    'meetings' => 'meetings/index', // actionIndex in MeetingsController

    'inviteUser/([0-9]+)' => 'user/inviteUser/$1',
    'addInvitedMember/([0-9]+)/([0-9]+)' => 'user/addInvitedMember/$1/$2',
    'user/([0-9]+)' => 'user/view/$1',
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'profile' => 'profile/index',
    'manageInterests' => 'profile/manageInterests',
    'deleteInterest/([0-9]+)' => 'profile/deleteInterest/$1',
    'addInterest/([0-9]+)' => 'profile/addInterest/$1',

    'createMeeting' => 'meetings/create',
    'addMember/([0-9]+)' => 'meetings/addMember/$1',
    'deleteMember/([0-9]+)' => 'meetings/deleteMember/$1',

    '' => 'home/index',
);
?>
