<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Crm;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\layouts\CollapsedMenu;
use App\Http\Controllers\layouts\ContentNavbar;
use App\Http\Controllers\layouts\ContentNavSidebar;
// use App\Http\Controllers\layouts\NavbarFull;
// use App\Http\Controllers\layouts\NavbarFullSidebar;
use App\Http\Controllers\layouts\Horizontal;
use App\Http\Controllers\layouts\Vertical;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\front_pages\Landing;
use App\Http\Controllers\front_pages\Pricing;
use App\Http\Controllers\front_pages\Payment;
use App\Http\Controllers\front_pages\Checkout;
use App\Http\Controllers\front_pages\HelpCenter;
use App\Http\Controllers\front_pages\HelpCenterArticle;
use App\Http\Controllers\apps\Email;
use App\Http\Controllers\apps\Chat;
use App\Http\Controllers\apps\Calendar;
use App\Http\Controllers\apps\Kanban;
use App\Http\Controllers\apps\EcommerceDashboard;
use App\Http\Controllers\apps\EcommerceProductList;
use App\Http\Controllers\apps\EcommerceProductAdd;
use App\Http\Controllers\apps\EcommerceProductCategory;
use App\Http\Controllers\apps\EcommerceOrderList;
use App\Http\Controllers\apps\EcommerceOrderDetails;
use App\Http\Controllers\apps\EcommerceCustomerAll;
use App\Http\Controllers\apps\EcommerceCustomerDetailsOverview;
use App\Http\Controllers\apps\EcommerceCustomerDetailsSecurity;
use App\Http\Controllers\apps\EcommerceCustomerDetailsBilling;
use App\Http\Controllers\apps\EcommerceCustomerDetailsNotifications;
use App\Http\Controllers\apps\EcommerceManageReviews;
use App\Http\Controllers\apps\EcommerceReferrals;
use App\Http\Controllers\apps\EcommerceSettingsDetails;
use App\Http\Controllers\apps\EcommerceSettingsPayments;
use App\Http\Controllers\apps\EcommerceSettingsCheckout;
use App\Http\Controllers\apps\EcommerceSettingsShipping;
use App\Http\Controllers\apps\EcommerceSettingsLocations;
use App\Http\Controllers\apps\EcommerceSettingsNotifications;
use App\Http\Controllers\apps\AcademyDashboard;
use App\Http\Controllers\apps\AcademyCourse;
use App\Http\Controllers\apps\AcademyCourseDetails;
use App\Http\Controllers\apps\LogisticsDashboard;
use App\Http\Controllers\apps\LogisticsFleet;
use App\Http\Controllers\apps\InvoiceList;
use App\Http\Controllers\apps\InvoicePreview;
use App\Http\Controllers\apps\InvoicePrint;
use App\Http\Controllers\apps\InvoiceEdit;
use App\Http\Controllers\apps\InvoiceAdd;
use App\Http\Controllers\apps\UserList;
use App\Http\Controllers\apps\UserViewAccount;
use App\Http\Controllers\apps\UserViewSecurity;
use App\Http\Controllers\apps\UserViewBilling;
use App\Http\Controllers\apps\UserViewNotifications;
use App\Http\Controllers\apps\UserViewConnections;
use App\Http\Controllers\apps\AccessRoles;
use App\Http\Controllers\apps\AccessPermission;
use App\Http\Controllers\pages\UserProfile;
use App\Http\Controllers\pages\UserTeams;
use App\Http\Controllers\pages\UserProjects;
use App\Http\Controllers\pages\UserConnections;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsSecurity;
use App\Http\Controllers\pages\AccountSettingsBilling;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\Faq;
use App\Http\Controllers\pages\Pricing as PagesPricing;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\pages\MiscComingSoon;
use App\Http\Controllers\pages\MiscNotAuthorized;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\LoginCover;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\RegisterCover;
use App\Http\Controllers\authentications\RegisterMultiSteps;
use App\Http\Controllers\authentications\VerifyEmailBasic;
use App\Http\Controllers\authentications\VerifyEmailCover;
use App\Http\Controllers\authentications\ResetPasswordBasic;
use App\Http\Controllers\authentications\ResetPasswordCover;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\authentications\ForgotPasswordCover;
use App\Http\Controllers\authentications\TwoStepsBasic;
use App\Http\Controllers\authentications\TwoStepsCover;
use App\Http\Controllers\wizard_example\Checkout as WizardCheckout;
use App\Http\Controllers\wizard_example\PropertyListing;
use App\Http\Controllers\wizard_example\CreateDeal;
use App\Http\Controllers\modal\ModalExample;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\cards\CardAdvance;
use App\Http\Controllers\cards\CardStatistics;
use App\Http\Controllers\cards\CardAnalytics;
// use App\Http\Controllers\cards\CardGamifications;
use App\Http\Controllers\cards\CardActions;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\Avatar;
use App\Http\Controllers\extended_ui\BlockUI;
use App\Http\Controllers\extended_ui\DragAndDrop;
use App\Http\Controllers\extended_ui\MediaPlayer;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\StarRatings;
use App\Http\Controllers\extended_ui\SweetAlert;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\extended_ui\TimelineBasic;
use App\Http\Controllers\extended_ui\TimelineFullscreen;
use App\Http\Controllers\extended_ui\Tour;
use App\Http\Controllers\extended_ui\Treeview;
use App\Http\Controllers\extended_ui\Misc;
use App\Http\Controllers\icons\Tabler;
use App\Http\Controllers\icons\FontAwesome;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_elements\CustomOptions;
use App\Http\Controllers\form_elements\Editors;
use App\Http\Controllers\form_elements\FileUpload;
use App\Http\Controllers\form_elements\Picker;
use App\Http\Controllers\form_elements\Selects;
use App\Http\Controllers\form_elements\Sliders;
use App\Http\Controllers\form_elements\Switches;
use App\Http\Controllers\form_elements\Extras;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\form_layouts\StickyActions;
use App\Http\Controllers\form_wizard\Numbered as FormWizardNumbered;
use App\Http\Controllers\form_wizard\Icons as FormWizardIcons;
use App\Http\Controllers\form_validation\Validation;
use App\Http\Controllers\tables\Basic as TablesBasic;
use App\Http\Controllers\tables\DatatableBasic;
use App\Http\Controllers\tables\DatatableAdvanced;
use App\Http\Controllers\tables\DatatableExtensions;
use App\Http\Controllers\charts\ApexCharts;
use App\Http\Controllers\charts\ChartJs;
use App\Http\Controllers\maps\Leaflet;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;

Route::get('/dashboard/analytics', [Analytics::class, 'index'])->name('dashboard-analytics');
// Route::get('/dashboard/crm', [Crm::class, 'index'])->name('dashboard-crm');
// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// layout
Route::get('/layouts/collapsed-menu', [CollapsedMenu::class, 'index'])->name('layouts-collapsed-menu');
Route::get('/layouts/content-navbar', [ContentNavbar::class, 'index'])->name('layouts-content-navbar');
Route::get('/layouts/content-nav-sidebar', [ContentNavSidebar::class, 'index'])->name('layouts-content-nav-sidebar');
// Route::get('/layouts/navbar-full', [NavbarFull::class, 'index'])->name('layouts-navbar-full');
// Route::get('/layouts/navbar-full-sidebar', [NavbarFullSidebar::class, 'index'])->name('layouts-navbar-full-sidebar');
// Route::get('/layouts/horizontal', [Horizontal::class, 'index'])->name('dashboard-analytics');
// Route::get('/layouts/vertical', [Vertical::class, 'index'])->name('dashboard-analytics');
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// Front Pages
Route::get('/front-pages/landing', [Landing::class, 'index'])->name('front-pages-landing');
Route::get('/front-pages/pricing', [Pricing::class, 'index'])->name('front-pages-pricing');
Route::get('/front-pages/payment', [Payment::class, 'index'])->name('front-pages-payment');
Route::get('/front-pages/checkout', [Checkout::class, 'index'])->name('front-pages-checkout');
Route::get('/front-pages/help-center', [HelpCenter::class, 'index'])->name('front-pages-help-center');
Route::get('/front-pages/help-center-article', [HelpCenterArticle::class, 'index'])->name(
  'front-pages-help-center-article'
);

// apps
Route::get('/app/email', [Email::class, 'index'])->name('app-email');
Route::get('/app/calendar', [Calendar::class, 'index'])->name('app-calendar');
Route::get('/app/kanban', [Kanban::class, 'index'])->name('app-kanban');
Route::get('/app/ecommerce/dashboard', [EcommerceDashboard::class, 'index'])->name('app-ecommerce-dashboard');
Route::get('/app/ecommerce/product/list', [EcommerceProductList::class, 'index'])->name('app-ecommerce-product-list');
Route::get('/app/ecommerce/product/add', [EcommerceProductAdd::class, 'index'])->name('app-ecommerce-product-add');
Route::get('/app/ecommerce/product/category', [EcommerceProductCategory::class, 'index'])->name(
  'app-ecommerce-product-category'
);
Route::get('/app/ecommerce/order/list', [EcommerceOrderList::class, 'index'])->name('app-ecommerce-order-list');
Route::get('app/ecommerce/order/details', [EcommerceOrderDetails::class, 'index'])->name('app-ecommerce-order-details');
Route::get('/app/ecommerce/customer/all', [EcommerceCustomerAll::class, 'index'])->name('app-ecommerce-customer-all');
Route::get('app/ecommerce/customer/details/overview', [EcommerceCustomerDetailsOverview::class, 'index'])->name(
  'app-ecommerce-customer-details-overview'
);
Route::get('app/ecommerce/customer/details/security', [EcommerceCustomerDetailsSecurity::class, 'index'])->name(
  'app-ecommerce-customer-details-security'
);
Route::get('app/ecommerce/customer/details/billing', [EcommerceCustomerDetailsBilling::class, 'index'])->name(
  'app-ecommerce-customer-details-billing'
);
Route::get('app/ecommerce/customer/details/notifications', [
  EcommerceCustomerDetailsNotifications::class,
  'index',
])->name('app-ecommerce-customer-details-notifications');
Route::get('/app/ecommerce/manage/reviews', [EcommerceManageReviews::class, 'index'])->name(
  'app-ecommerce-manage-reviews'
);
Route::get('/app/ecommerce/referrals', [EcommerceReferrals::class, 'index'])->name('app-ecommerce-referrals');
Route::get('/app/ecommerce/settings/details', [EcommerceSettingsDetails::class, 'index'])->name(
  'app-ecommerce-settings-details'
);
Route::get('/app/ecommerce/settings/payments', [EcommerceSettingsPayments::class, 'index'])->name(
  'app-ecommerce-settings-payments'
);
Route::get('/app/ecommerce/settings/checkout', [EcommerceSettingsCheckout::class, 'index'])->name(
  'app-ecommerce-settings-checkout'
);
Route::get('/app/ecommerce/settings/shipping', [EcommerceSettingsShipping::class, 'index'])->name(
  'app-ecommerce-settings-shipping'
);
Route::get('/app/ecommerce/settings/locations', [EcommerceSettingsLocations::class, 'index'])->name(
  'app-ecommerce-settings-locations'
);
Route::get('/app/ecommerce/settings/notifications', [EcommerceSettingsNotifications::class, 'index'])->name(
  'app-ecommerce-settings-notifications'
);
Route::get('/app/academy/dashboard', [AcademyDashboard::class, 'index'])->name('app-academy-dashboard');
Route::get('/app/academy/course', [AcademyCourse::class, 'index'])->name('app-academy-course');
Route::get('/app/academy/course-details', [AcademyCourseDetails::class, 'index'])->name('app-academy-course-details');
Route::get('/app/logistics/dashboard', [LogisticsDashboard::class, 'index'])->name('app-logistics-dashboard');
Route::get('/app/logistics/fleet', [LogisticsFleet::class, 'index'])->name('app-logistics-fleet');
Route::get('/app/invoice/list', [InvoiceList::class, 'index'])->name('app-invoice-list');
Route::get('/app/invoice/preview', [InvoicePreview::class, 'index'])->name('app-invoice-preview');
Route::get('/app/invoice/print', [InvoicePrint::class, 'index'])->name('app-invoice-print');
Route::get('/app/invoice/edit', [InvoiceEdit::class, 'index'])->name('app-invoice-edit');
Route::get('/app/invoice/add', [InvoiceAdd::class, 'index'])->name('app-invoice-add');
Route::get('/app/user/list', [UserList::class, 'index'])->name('app-user-list');
Route::get('/app/user/view/account', [UserViewAccount::class, 'index'])->name('app-user-view-account');
Route::get('/app/user/view/security', [UserViewSecurity::class, 'index'])->name('app-user-view-security');
Route::get('/app/user/view/billing', [UserViewBilling::class, 'index'])->name('app-user-view-billing');
Route::get('/app/user/view/notifications', [UserViewNotifications::class, 'index'])->name(
  'app-user-view-notifications'
);
Route::get('/app/user/view/connections', [UserViewConnections::class, 'index'])->name('app-user-view-connections');
Route::get('/app/access-roles', [AccessRoles::class, 'index'])->name('app-access-roles');
Route::get('/app/access-permission', [AccessPermission::class, 'index'])->name('app-access-permission');

// pages
Route::get('/pages/profile-user', [UserProfile::class, 'index'])->name('pages-profile-user');
Route::get('/pages/profile-teams', [UserTeams::class, 'index'])->name('pages-profile-teams');
Route::get('/pages/profile-projects', [UserProjects::class, 'index'])->name('pages-profile-projects');
Route::get('/pages/profile-connections', [UserConnections::class, 'index'])->name('pages-profile-connections');
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
  'pages-account-settings-account'
);
Route::get('/pages/account-settings-security', [AccountSettingsSecurity::class, 'index'])->name(
  'pages-account-settings-security'
);
Route::get('/pages/account-settings-billing', [AccountSettingsBilling::class, 'index'])->name(
  'pages-account-settings-billing'
);
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
  'pages-account-settings-notifications'
);
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
  'pages-account-settings-connections'
);
Route::get('/pages/faq', [Faq::class, 'index'])->name('pages-faq');
Route::get('/pages/pricing', [PagesPricing::class, 'index'])->name('pages-pricing');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
  'pages-misc-under-maintenance'
);
Route::get('/pages/misc-comingsoon', [MiscComingSoon::class, 'index'])->name('pages-misc-comingsoon');
Route::get('/pages/misc-not-authorized', [MiscNotAuthorized::class, 'index'])->name('pages-misc-not-authorized');

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/login-cover', [LoginCover::class, 'index'])->name('auth-login-cover');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/register-cover', [RegisterCover::class, 'index'])->name('auth-register-cover');
Route::get('/auth/register-multisteps', [RegisterMultiSteps::class, 'index'])->name('auth-register-multisteps');
Route::get('/auth/verify-email-basic', [VerifyEmailBasic::class, 'index'])->name('auth-verify-email-basic');
Route::get('/auth/verify-email-cover', [VerifyEmailCover::class, 'index'])->name('auth-verify-email-cover');
Route::get('/auth/reset-password-basic', [ResetPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
Route::get('/auth/reset-password-cover', [ResetPasswordCover::class, 'index'])->name('auth-reset-password-cover');
// Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
Route::get('/auth/forgot-password-cover', [ForgotPasswordCover::class, 'index'])->name('auth-forgot-password-cover');
Route::get('/auth/two-steps-basic', [TwoStepsBasic::class, 'index'])->name('auth-two-steps-basic');
Route::get('/auth/two-steps-cover', [TwoStepsCover::class, 'index'])->name('auth-two-steps-cover');

// wizard example
Route::get('/wizard/ex-checkout', [WizardCheckout::class, 'index'])->name('wizard-ex-checkout');
Route::get('/wizard/ex-property-listing', [PropertyListing::class, 'index'])->name('wizard-ex-property-listing');
Route::get('/wizard/ex-create-deal', [CreateDeal::class, 'index'])->name('wizard-ex-create-deal');

// modal
Route::get('/modal-examples', [ModalExample::class, 'index'])->name('modal-examples');

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');
Route::get('/cards/advance', [CardAdvance::class, 'index'])->name('cards-advance');
Route::get('/cards/statistics', [CardStatistics::class, 'index'])->name('cards-statistics');
Route::get('/cards/analytics', [CardAnalytics::class, 'index'])->name('cards-analytics');
// Route::get('/cards/gamifications', [CardGamifications::class, 'index'])->name('cards-gamifications');
Route::get('/cards/actions', [CardActions::class, 'index'])->name('cards-actions');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-avatar', [Avatar::class, 'index'])->name('extended-ui-avatar');
Route::get('/extended/ui-blockui', [BlockUI::class, 'index'])->name('extended-ui-blockui');
Route::get('/extended/ui-drag-and-drop', [DragAndDrop::class, 'index'])->name('extended-ui-drag-and-drop');
Route::get('/extended/ui-media-player', [MediaPlayer::class, 'index'])->name('extended-ui-media-player');
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-star-ratings', [StarRatings::class, 'index'])->name('extended-ui-star-ratings');
Route::get('/extended/ui-sweetalert2', [SweetAlert::class, 'index'])->name('extended-ui-sweetalert2');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');
Route::get('/extended/ui-timeline-basic', [TimelineBasic::class, 'index'])->name('extended-ui-timeline-basic');
Route::get('/extended/ui-timeline-fullscreen', [TimelineFullscreen::class, 'index'])->name(
  'extended-ui-timeline-fullscreen'
);
Route::get('/extended/ui-tour', [Tour::class, 'index'])->name('extended-ui-tour');
Route::get('/extended/ui-treeview', [Treeview::class, 'index'])->name('extended-ui-treeview');
Route::get('/extended/ui-misc', [Misc::class, 'index'])->name('extended-ui-misc');

// icons
Route::get('/icons/tabler', [Tabler::class, 'index'])->name('icons-tabler');
Route::get('/icons/font-awesome', [FontAwesome::class, 'index'])->name('icons-font-awesome');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');
Route::get('/forms/custom-options', [CustomOptions::class, 'index'])->name('forms-custom-options');
Route::get('/forms/editors', [Editors::class, 'index'])->name('forms-editors');
Route::get('/forms/file-upload', [FileUpload::class, 'index'])->name('forms-file-upload');
Route::get('/forms/pickers', [Picker::class, 'index'])->name('forms-pickers');
Route::get('/forms/selects', [Selects::class, 'index'])->name('forms-selects');
Route::get('/forms/sliders', [Sliders::class, 'index'])->name('forms-sliders');
Route::get('/forms/switches', [Switches::class, 'index'])->name('forms-switches');
Route::get('/forms/extras', [Extras::class, 'index'])->name('forms-extras');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');
Route::get('/form/layouts-sticky', [StickyActions::class, 'index'])->name('form-layouts-sticky');

// form wizards
Route::get('/form/wizard-numbered', [FormWizardNumbered::class, 'index'])->name('form-wizard-numbered');
Route::get('/form/wizard-icons', [FormWizardIcons::class, 'index'])->name('form-wizard-icons');
Route::get('/form/validation', [Validation::class, 'index'])->name('form-validation');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
Route::get('/tables/datatables-basic', [DatatableBasic::class, 'index'])->name('tables-datatables-basic');
Route::get('/tables/datatables-advanced', [DatatableAdvanced::class, 'index'])->name('tables-datatables-advanced');
Route::get('/tables/datatables-extensions', [DatatableExtensions::class, 'index'])->name(
  'tables-datatables-extensions'
);

// charts
Route::get('/charts/apex', [ApexCharts::class, 'index'])->name('charts-apex');
Route::get('/charts/chartjs', [ChartJs::class, 'index'])->name('charts-chartjs');

// maps
Route::get('/maps/leaflet', [Leaflet::class, 'index'])->name('maps-leaflet');

// laravel example
Route::get('/laravel/user-management', [UserManagement::class, 'UserManagement'])->name(
  'laravel-example-user-management'
);
Route::resource('/user-list', UserManagement::class);

// THE APP ROUTE
Route::middleware(['auth'])->group(function () {
  Route::get('/', [Crm::class, 'index'])->name('dashboard-crm');
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
  // Route::get('/lead/get-all-leads', [LeadController::class, 'getAllLeads'])->name('lead.getAllLeads');
  // Route::get('/lead/create', [LeadController::class, 'create'])->name('lead.create');
  // Route::get('/lead/edit/{lead}', [LeadController::class, 'edit'])->name('lead.edit');
  // Route::put('/lead/edit/{lead}', [LeadController::class, 'update'])->name('lead.update');
  // Route::post('/lead/store', [LeadController::class, 'store'])->name('lead.store');
  Route::get('app/chat', [Chat::class, 'index'])->name('lead-list');

  //DEALER
  // Route::resource('dealer', DealerController::class);
  Route::get('dealers', [DealerController::class, 'index'])->name('dealers.index');
  Route::get('dealers/create', [DealerController::class, 'create'])->name('dealers.create');
  Route::post('dealers', [DealerController::class, 'store'])->name('dealers.store');
  Route::get('dealers/{id}', [DealerController::class, 'show'])->name('dealers.show');
  Route::get('dealers/{id}/edit', [DealerController::class, 'edit'])->name('dealers.edit');
  Route::put('dealers/{id}', [DealerController::class, 'update'])->name('dealers.update');
  Route::delete('dealers/{id}', [DealerController::class, 'destroy'])->name('dealers.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('leads', [LeadController::class, 'index'])->name('leads.index');
  Route::get('leads/create', [LeadController::class, 'create'])->name('leads.create');
  Route::post('leads', [LeadController::class, 'store'])->name('leads.store');
  Route::get('leads/{id}', [LeadController::class, 'show'])->name('leads.show');
  Route::get('leads/{id}/edit', [LeadController::class, 'edit'])->name('leads.edit');
  Route::put('leads/{id}', [LeadController::class, 'update'])->name('leads.update');
  Route::delete('leads/{id}', [LeadController::class, 'destroy'])->name('leads.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('groups', [GroupController::class, 'index'])->name('group-list');
  Route::get('groups/create', [GroupController::class, 'create'])->name('groups.create');
  Route::post('groups', [GroupController::class, 'store'])->name('groups.store');
  Route::get('groups/{id}', [GroupController::class, 'show'])->name('groups.show');
  Route::get('groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
  Route::put('groups/{id}', [GroupController::class, 'update'])->name('groups.update');
  Route::delete('groups/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');
  Route::get('profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
  Route::post('profiles', [ProfileController::class, 'store'])->name('profiles.store');
  Route::get('profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
  Route::get('profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
  Route::put('profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
  Route::delete('profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

  // Route::resource('Task', TaskController::class);
  Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
  Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
  Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
  Route::get('tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
  Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
  Route::put('tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
  Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

  // Route::resource('Customer', CustomerController::class);
  Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
  Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
  Route::post('customers', [CustomerController::class, 'store'])->name('customers.store');
  Route::get('customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
  Route::get('customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
  Route::put('customers/{id}', [CustomerController::class, 'update'])->name('customers.update');
  Route::delete('customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
  Route::get('customers/{id}/email', [CustomerController::class, 'detailEmail'])->name('customers.detailEmail');
  Route::get('customers/{id}/ticket', [CustomerController::class, 'detailTicket'])->name('customers.detailTicket');
  Route::post('customers/add-contact', [CustomerController::class, 'addContact'])->name('customers.add-contact');

  // Route::resource('dealer', DealerController::class);
  Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
  Route::get('clients/create', [ClientController::class, 'create'])->name('clients.create');
  Route::post('clients', [ClientController::class, 'store'])->name('clients.store');
  Route::get('clients/{id}', [ClientController::class, 'show'])->name('clients.show');
  Route::get('clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
  Route::put('clients/{id}', [ClientController::class, 'update'])->name('clients.update');
  Route::delete('clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('teams', [TeamController::class, 'index'])->name('teams.index');
  Route::get('teams/create', [TeamController::class, 'create'])->name('teams.create');
  Route::post('teams', [TeamController::class, 'store'])->name('teams.store');
  Route::get('teams/{id}', [TeamController::class, 'show'])->name('teams.show');
  Route::get('teams/{id}/edit', [TeamController::class, 'edit'])->name('teams.edit');
  Route::put('teams/{id}', [TeamController::class, 'update'])->name('teams.update');
  Route::delete('teams/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('products', [ProductController::class, 'index'])->name('products.index');
  Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
  Route::post('products', [ProductController::class, 'store'])->name('products.store');
  Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
  Route::get('products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
  Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
  Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
  Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
  Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
  Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show');
  Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
  Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
  Route::delete('roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

  // Route::resource('dealer', DealerController::class);
  Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
  Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
  Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
  Route::get('permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
  Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
  Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
  Route::delete('permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

  Route::get('call', [CallController::class, 'index'])->name('call-list');

  // TICKETS
  Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
  Route::post('tickets/upsert', [TicketController::class, 'upsert'])->name('tickets.upsert');
  Route::post('tickets/add-assignee', [TicketController::class, 'addAssignee'])->name('tickets.add-assignee');

  // Route::get('/kanban', function () {
  //   return view('content.apps.app-kanban'); // Your Blade template name
  // });
});

//AUTH ROUTES

Route::middleware(['guest'])->group(function () {
  Route::get('/login', [AuthController::class, 'loginPage']);
  Route::post('/login', [AuthController::class, 'login'])->name('login');
  Route::get('/sign-up', [AuthController::class, 'signUp'])->name('register');
});
