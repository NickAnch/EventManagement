<?php
return array(
    'meetings/([0-9]+)' => 'meetings/view/$1',
    'meetings/page-([0-9]+)' => 'meetings/index/$1',
    'editMeeting/([0-9]+)' => 'meetings/editMeeting/$1',
    'meetings' => 'meetings/index', // actionIndex in MeetingsController

    'inviteUser/([0-9]+)' => 'user/inviteUser/$1',
    'addInvitedMember/([0-9]+)/([0-9]+)' => 'user/addInvitedMember/$1/$2',
    'user/([0-9]+)' => 'user/view/$1',
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'profile' => 'profile/index',
    'manageInterests' => 'profile/manageInterests',
    'eventNotifications' => 'profile/eventNotifications',
    'edit' => 'profile/edit',
    'deleteInterest/([0-9]+)' => 'profile/deleteInterest/$1',
    'addInterest/([0-9]+)' => 'profile/addInterest/$1',
    'deleteNotification/([0-9]+)' => 'profile/deleteNotification/$1',


    'admin/theme/create' => 'adminTheme/create',
    'admin/theme/update/([0-9]+)' => 'adminTheme/update/$1',
    'admin/theme/delete/([0-9]+)' => 'adminTheme/delete/$1',
    'admin/theme' => 'adminTheme/index',

    'admin/meetup/update/([0-9]+)' => 'adminMeetup/update/$1',
    'admin/meetup/delete/([0-9]+)' => 'adminMeetup/delete/$1',
    'admin/meetup/view/([0-9]+)' => 'adminMeetup/view/$1',
    'admin/meetup' => 'adminMeetup/index',
    
    'admin' => 'admin/index',

    'createMeeting' => 'meetings/create',
    'getRecommendedMeetings/([0-9]+)' => 'meetings/getRecommendedMeetings/$1',
    'getRecommendedMeetings/([0-9]+)/([0-9]+)' => 'meetings/getRecommendedMeetings/$1/$2',
    'recommendation' => 'meetings/recommendation',
    'addMember/([0-9]+)' => 'meetings/addMember/$1',
    'deleteMember/([0-9]+)' => 'meetings/deleteMember/$1',

    '' => 'home/index',
);
?>
