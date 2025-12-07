<?php include_once $_SERVER["DOCUMENT_ROOT"].'/view/global/main-header.php'; ?>

<?= smart_css('/styles/css/global/main-menu.css') ?>

<?php
// Slovenski menu elementi
$menu_items = [    
    'naloge' => [
        'type' => 'dropdown',
        'text' => 'Naloge',
        'items' => [            
            'naloga1' => ['text' => 'Eksperiment 67-A', 'url' => '/naloga1'],                        
        ]
    ],
    'odjava' => [
        'type' => 'link',
        'text' => 'Odjava',
        'url' => '/public/odjava.php'
    ]
    
];

// Dovoljenja glede na nivo uporabnika
$role_permissions = [
    // Admin
    20 => [
        'naloge',       
        'odjava',
    ],

];

function renderMenu($userRole, $menu_items, $role_permissions) {
    $accessible_items = $role_permissions[$userRole] ?? [];

    $html = '';

    foreach ($accessible_items as $key => $value) {
        if (is_numeric($key)) {
            $itemKey = $value;
        } else {
            $itemKey = $key;
        }
        
        $limitedItems = is_array($value) && isset($value['items']) ? $value['items'] : null;

        if (!isset($menu_items[$itemKey])) continue;

        $item = $menu_items[$itemKey];

        switch ($item['type']) {
            case 'iskalnik':
                $html .= '<div class="iskalnikholder">';
                $html .= '<a href="' . $item['url'] . '"><img src="' . $item['icon'] . '" alt="' . $item['alt'] . '" id="' . $item['id'] . '"></a>';
                $html .= '</div>';
                break;

            case 'link':
                $html .= '<div class="menielement"><a class="alt" href="' . $item['url'] . '">' . $item['text'] . '</a></div>';
                break;

            case 'dropdown':
                $html .= '<div class="menielement">';

                // Pripravi seznam dovoljenih pod-elementov (če ima uporabnik omejen dostop do določenih)
                $allowedSubItems = [];
                foreach ($item['items'] as $subKey => $subItem) {
                        // Če ni omejitev ali če je ta podmeni dovoljen, ga dodaj v seznam
                    if (!$limitedItems || in_array($subKey, $limitedItems)) {
                        $allowedSubItems[$subKey] = $subItem;
                    }
                }

                // Če ima uporabnik dostop samo do enega podmenija, ga prikažemo kot običajen link (ne dropdown)
                if (count($allowedSubItems) === 1) {
                    $singleItem = array_values($allowedSubItems)[0];
                    $html .= '<a class="alt" href="' . $singleItem['url'] . '">' . $singleItem['text'] . '</a>';
                } else {
                        // Če je več dovoljenih podmenijev, prikažemo dropdown
                    $html .= '<div class="menielement-vec" data-menistatus="zaprt"><a class="alt" href="#">' . $item['text'] . ' <div class="triangle">▸</div></a></div>';
                    
                    foreach ($allowedSubItems as $subItem) {
                        $html .= '<div class="menielement-skrit"><a class="alt" href="' . $subItem['url'] . '"> - ' . $subItem['text'] . '</a></div>';
                    }
                }

                $html .= '</div>';

                break;
        }
    }

    return $html;
}
?>


<img src="/media/logo-masa.png" id="burgermenu" alt="menu icon">

<div id="leftmenu">
<a href='/'><img src="/media/logo-masa.png" alt="Maša Udovič" id="leftmenu-logo"></a>
<?php
    echo renderMenu(20, $menu_items, $role_permissions);
?>
</div>
