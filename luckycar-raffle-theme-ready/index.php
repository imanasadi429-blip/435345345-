<?php get_header(); ?>
<main>
  <section class="hero">
    <div class="hero-content">
      <h1>قرعه‌کشی پراید شانس</h1>
      <p>با ۵۰۰ هزار تومان شرکت کنید و برنده شوید!</p>
      <?php echo do_shortcode('[participant_counter current="850"]'); ?>
      <button class="cta-button">شرکت کنید</button>
      <?php echo do_shortcode('[3d_car]'); ?>
    </div>
  </section>
  <section class="dashboard">
    <?php echo do_shortcode('[wallet_balance]'); ?>
    <?php echo do_shortcode('[referral_link]'); ?>
  </section>
</main>
<?php get_footer(); ?>