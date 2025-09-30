<?php
/* Template Name: Custom Page */
get_header(); 
if (is_page('dashboard')) {
  if (!is_user_logged_in()) wp_redirect(wp_login_url());
}
?>
<main class="dashboard">
  <?php if (is_page('dashboard')) : ?>
    <h2>داشبورد شما</h2>
    [wallet_balance]
    [referral_link]
    <button class="cta-button">پرداخت ۵۰۰ هزار تومان</button>
  <?php elseif (is_page('payment')) : ?>
    <h2>پرداخت</h2>
    <form method="post">
      <div class="form-group">
        <label>مبلغ: ۵۰۰,۰۰۰ تومان</label>
        <button type="submit" class="cta-button">پرداخت با زرین‌پال</button>
      </div>
    </form>
  <?php elseif (is_page('withdrawal')) : ?>
    <h2>برداشت وجه</h2>
    <form method="post">
      <div class="form-group">
        <label>مبلغ برداشت</label>
        <input type="number" name="amount" min="200000">
        <button type="submit" class="cta-button">درخواست برداشت</button>
      </div>
    </form>
  <?php elseif (is_page('results')) : ?>
    <h2>نتایج قرعه‌کشی</h2>
    <p>برنده: <?php echo wp_rand(1, 1000); ?> (تصادفی)</p>
  <?php elseif (is_page('lottery-details')) : ?>
    <h2>جزئیات قرعه‌کشی</h2>
    [3d_car]
    <p>قرعه‌کشی تصادفی با ۱۰۰۰ شرکت‌کننده</p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>