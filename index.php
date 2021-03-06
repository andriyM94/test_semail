<?php

// Посилання яке ми опрацьовуємо
$link = "https://jobs.dou.ua/companies/semalt/poll/";

// функція визначення домена та піддомена
function what_is_it($link) {

    // Видаляємо з посилання назву використаного протоколу передачі даних
    $our_link = preg_replace('/(http\:\/\/|https\:\/\/|\/\/)/', '', $link);
    // Залишаємо від посилання тільки домен і його піддомени якщо існують
    if (parse_url('http://'.$our_link)) { // добавляємо http:// до посилання для коректної роботи parse_url
        // $full_path масив з даними опрацьованими функцією parse_url
        $full_path = parse_url('http://'.$our_link);
        //  перезаписумо змінну $our_link і записуємо в неї значення повного доменного імені
        $our_link = $full_path['host']; 
        // видаляємо www. з нашої очищеного посилання
        $our_link = str_replace('www.', '', $our_link);
    }
    
    // розділяємо наше опрацьоване посилання на елеменит мисива
    $elements = explode(".", $our_link);
    // відокремлюємо елементи масива які формують домен (останні два елементи)
    $domain = array_slice($elements, count($elements) - 2);
    // заносимо в змінну $domain_name ім'я домена
    $domain_name = implode(".",$domain);
    // перевіряємо чи наша силка містьть піддомени
    if  (count($elements) > 2) { // якщо містить піддомени
        // формуємо масив елементів які стосуються піддомена
        $subdomain = array_slice($elements, 0 , -2);
        // створюємо стрічку з назвою піддомена
        $subdomain_name = implode(".",$subdomain);
        // виясняємо рівень нашого піддомена
        $level = count($elements) - 2;
        // виводимо рівень піддомена його повне "ім'я" та домен якому належить
        echo "Піддомен ". $level ." рівня - <b>" . $subdomain_name . "</b> домена: <b>" . $domain_name . "</b>";
    } else { // якшо піддоменів нема
        // Виводимо ім'я домена
        echo "Домен - <b>" . $domain_name . "</b>";
    }
}

// викликаємо нашу функцію визначення домена та піддомена
what_is_it($link);

?>