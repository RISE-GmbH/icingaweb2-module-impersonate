<?php
$this->providePermission(
    'impersonate/user',
    $this->translate('Allow impersonating other user')
);


$section = $this->menuSection(N_('Impersonate'),[
    'permission'    => 'impersonate/user',
    'url'           => 'impersonate/user',
    'icon'          => 'lock-open-alt',
    'priority'      => 60
]);
?>
