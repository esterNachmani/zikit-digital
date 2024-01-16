<?php
/*
Template Name: My Login
*/
get_header();


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    <div class="u-columns col2-set" id="customer_login">



    <!--    <div class="u-column2 col-2">-->
    <!---->
    <!--        <h2>אני לקוח חדש</h2>-->
    <!---->
    <!--        <form method="post" class="woocommerce-form woocommerce-form-register register" --><?php //do_action( 'woocommerce_register_form_tag' ); ?><!-- >-->
    <!---->
    <!--            --><?php //do_action( 'woocommerce_register_form_start' ); ?>
    <!---->
    <!--            --><?php //if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
    <!---->
    <!--                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">-->
    <!--                    <label for="reg_username">--><?php //esc_html_e( 'Username', 'woocommerce' ); ?><!--&nbsp;<span class="required">*</span></label>-->
    <!--                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="--><?php //echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?><!--" />--><?php //// @codingStandardsIgnoreLine ?>
    <!--                </p>-->
    <!---->
    <!--            --><?php //endif; ?>
    <!---->
    <!--            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">-->
    <!--                <label for="reg_email">--><?php //esc_html_e( 'Email address', 'woocommerce' ); ?><!--&nbsp;<span class="required">*</span></label>-->
    <!--                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="--><?php //echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?><!--" />--><?php //// @codingStandardsIgnoreLine ?>
    <!--            </p>-->
    <!---->
    <!--            --><?php //if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
    <!---->
    <!--                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">-->
    <!--                    <label for="reg_password">--><?php //esc_html_e( 'Password', 'woocommerce' ); ?><!--&nbsp;<span class="required">*</span></label>-->
    <!--                    <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />-->
    <!--                </p>-->
    <!---->
    <!--            --><?php //else : ?>
    <!---->
    <!--                <p>--><?php //esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?><!--</p>-->
    <!---->
    <!--            --><?php //endif; ?>
    <!---->
    <!--            --><?php //do_action( 'woocommerce_register_form' ); ?>
    <!---->
    <!--            <p class="woocommerce-form-row form-row">-->
    <!--                --><?php //wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
    <!--                				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="--><?php ////esc_attr_e( 'Register', 'woocommerce' ); ?><!--">הרשמה לאתר</button>-->
    <!--            </p>-->
    <!--            <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="--><?php //esc_attr_e( 'Register', 'woocommerce' ); ?><!--">הרשמה לאתר</button>-->
    <!--            --><?php //do_action( 'woocommerce_register_form_end' ); ?>
    <!---->
    <!--        </form>-->
    <!---->
    <!--    </div>-->
    <div class="u-column1 col-1">

<?php endif; ?>

    <h2>יש לי חשבון באתר</h2>

    <form class="woocommerce-form woocommerce-form-login login" method="post">

        <?php do_action( 'woocommerce_login_form_start' ); ?>

        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
        </p>
        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
            <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
        </p>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <p class="form-row">
            <!--                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">-->
            <!--                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span>--><?php //esc_html_e( 'Remember me', 'woocommerce' ); ?><!--</span>-->
            <!--                </label>-->
            <!--            <p class="woocommerce-LostPassword lost_password">-->
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">שכחתי ססמא</a>
            <!--            </p>-->
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <!--           <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="--><?php //esc_attr_e( 'Log in', 'woocommerce' ); ?><!--">כניסה</button>-->


        </p>
        <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>">כניסה</button>


        <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

    </div>

    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' );

get_footer();
?>


