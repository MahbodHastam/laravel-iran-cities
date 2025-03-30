<?php

if (!function_exists('fa_to_en')) {
  function fa_to_en($text)
  {
    $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($fa_num, $en_num, $text);
  }
}

if (!function_exists('str_to_slug')) {
  function str_to_slug(string $string, string $separator = '-')
  {
    $string = fa_to_en(trim(mb_strtolower($string)));
    $string = preg_replace('![' . preg_quote($separator === '-' ? '_' : '-') . ']+!u', $separator, $string);

    return preg_replace(
      '/\\' . $separator . '{2,}/',
      $separator,
      preg_replace('/[^A-Za-z0-9\x{0620}-\x{064A}\x{0698}\x{067E}\x{0686}\x{06AF}\x{06CC}\x{06A9}]/ui', $separator, $string)
    );
  }
}