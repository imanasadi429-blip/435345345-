<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-theme="light">
  <header>
    <button id="dark-mode-toggle">🌙</button>
    <nav>
      <ul>
        <li><a href="/">خانه</a></li>
        <li><a href="/dashboard">داشبورد</a></li>
        <li><a href="/payment">پرداخت</a></li>
        <li><a href="/withdrawal">برداشت</a></li>
        <li><a href="/results">نتایج</a></li>
        <li><a href="/lottery-details">جزئیات</a></li>
      </ul>
    </nav>
  </header>