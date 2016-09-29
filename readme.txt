=== On Point ===

Contributors: AmmoCan
Tags: dark, one-page, one-column, two-columns, three-columns, foundation, font-awesome, flex-grid, fluid-layout, responsive-layout, translation-ready, custom-background, custom-header, custom-menu, featured-images, post-formats
Requires at least: 4.6
Tested up to: 4.6.1
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0-standalone.html

A WordPress modern and minimalistic one page responsive theme called On Point.

== Description ==

Hi. I'm a modern one page responsive theme called On Point. I'm built with ZURB's Foundation for Sites (Foundation 6) and Automattic's Underscores (_s). I'm designed to be a minimalistic and efficient way for freelancers and other professionals to showcase themselves, their services and their work. Feel free to use me and modify me as you see fit.

= Requirements: =
  * A need for a modern one page responsive theme.
  * A sense of humor.

== Installation ==

You will need to install this theme manually:

1. If not done already, download and unzip the 'on-point' archive.
2. Inside the 'on-point' theme folder locate the folder labeled 'plugins'.
3. Inside the 'plugins' folder, there should be three (3) files: project-posttype.php, services-posttype.php, testimonial-posttype.php.
4. Take these three (3) files and place them into your plugins folder (/wp-content/plugins/).
5. Now take the 'on-point' theme folder and place it into your themes folder (/wp-content/themes/).
6. Sign in into your website (http://example.com/wp-login.php).
7. Go to Appearance -> Themes, mouse over the On Point theme and click the 'Activate' button.
8. Go to Plugins -> Installed Plugins and activate the Projects Post Type, Services Post Type and Testimonials Post Type.

== Theme Customizer ==

On Point makes use of the built in Theme Customizer. Once you have activated On Point, go to Appearance -> Customize. The theme customizer of On Point has seven (7) option panels. Each panel contains sections which allow you to modify On Point.

= Site Identity =

This panel allows you to modify the sites identity, which consists of: logo, site title, site tagline/description and site icon.

* Logo - Add a logo to be displayed in the top left corner. You will be asked to crop the logo to 49px x 49px. If you don't provide a logo, the first letter of your site's title will be used.
* Site Title - Add a site title to be displayed in the top right corner. If a logo isn't provided, the first letter of this title will be used for the logo.
* Site Tagline/Description - Add a site tagline/description. This is used by the Open Graph protocol and is displayed in the footer.
* Site Icon - Add a site icon, which will need to be 512px x 512px. This is used for your favicon and for mobile devices. 

= Colors =

This panel allows you to modify the sites colors, which consists of: header text color, background color and header background color.

* Header Text Color - Change the mouse hover and mobile tap state color of the site's title, which is located in the top right corner.
* Background Color - Change the color of the background.
* Header Background Color - Change the background color of the header section when there is no header image selected.

= Header Image =

This panel allows you to add an image to the site's header section, which will be displayed on the site's front page.

* Header Image - Add an image to be displayed in the header section of the front page. You will be asked to crop the image to 1920px × 1080px.

(Notice: A header image needs to be provided for the Profile section to be visible.)

== Background Image ==

This panel allows you to add a background image to the site's body section, which will be displayed behind the site's content.

* Background Image - Add a background image to be displayed behind your site's content.

(Notice: Adding a background image will require some adjustments to the theme's CSS.)

= Menus =

This panel adds custom menu management to the Customizer. It allows you to live-preview changes to your menus before they're published. On Point supports three (3) menu locations:

1. Front Page Menu
2. Single Page Menu
3. Social Links Menu

(Notice: After you create your menus, you can select which menu appears in each location. Make sure you see the "Configure Menus" section below to set up your menus correctly.)

= Widgets =

This panel adds custom widget management to the Customizer. It allows you to live-preview changes and add/remove widgets to the widgetized areas, which On Point supports the following three (3) areas:

1. Footer Left Area - A widget area for the left side of your site's footer (will only appear if a widget is added).
2. Footer Center - A second widget area for the center of your site's footer (will only appear if a widget is added).
3. Footer Right - A third widget area for the right side of your site's footer (will only appear if a widget is added).

(Notice: If you create a 'Contact' page the content of that page will be displayed in place of the widgets, and the Widget Panel will not show any widget areas.)

= Static Front Page =

This panel adds custom management of the static front page. It allows you to choose what the front page of the site displays, and what page to use as the front page and what page to use for the posts page.

1. Front Page Displays - You can choose the front page to either display your latest posts or a static page. This theme requires you to choose the front page to display a static page.
2. Front Page - You can choose which page to use as your front page. This theme requires you to create a page named 'Home' and use as your front page.
3. Posts Page - You can choose which page to use as the page to display your posts. The theme requires you to create and select a page to be used if you want to display your posts on the front page. 

== Configure Menus ==

On Point allows you to display three different types of menus. The Primary menu is the Front Page Menu and is to be used on the front page. The Secondary menu is the Single Page Menu and is to be used on any page other than the front page (i.e. a single post page). The Social menu is the Social Links Menu and is used in the Profile section within the header on the front page.

= Front Page Menu - Allows you to display links to each of the content sections of the front page =

  Set Up
	============
	1. Go to Appearance->Menus, click on 'create a new menu' and under 'Menu Settings' check the box next to 'Front Page Menu'.
	2. Add links to each of your content sections of the front page by using the 'Custom Links' tab located on the left side.
	  A. Home - URL: #masthead - Link Text: Home
	  B. Services - URL: #services - Link Text: Services
	  C. Testimonials - URL: #testimonials - Link Text: Testimonials
	  D. Projects - URL: #projects - Link Text: Projects
	  E. Blog - URL: #blog - Link Text: Blog
	  F. Contact - URL: #contact - Link Text: Contact
	3. After adding all of your front page content section links to your menu, click on the 'Save Menu' button.
	
	(Notice: The link text can be changed to your heart's desire, but the URLs must remain the same as above.)
	
= Single Page Menu - Allows you to display links back to each of the content sections on the front page, when viewing a single post page. =

  Set Up
	============
	1. Go to Appearance->Menus, click on 'create a new menu' and under 'Menu Settings' check the box next to 'Single Page Menu'.
	2. Add links to each of the content sections located on the front page by using the 'Custom Links' panel located on the left side.
	  A. Home - URL: #masthead - Link Text: Home
	  B. Services - URL: http://Your-Site's-URL/#services - Link Text: Services
	  C. Testimonials - URL: http://Your-Site's-URL/#testimonials - Link Text: Testimonials
	  D. Projects - URL: http://Your-Site's-URL/#projects - Link Text: Projects
	  E. Contact - URL: http://Your-Site's-URL/#contact - Link Text: Contact
	3. After adding all of your links to the content sections on your front page to your menu, click on the 'Save Menu' button.
	
	(Notice: The link text can be changed to your heart's desire, but the URL must start with your site's URL and have the content section's ID appended to it.)

= Social Links Menu - Allows you to display links to your professional social media profiles, like LinkedIn, with Font-Awesome icons. =

	Set Up
	============
	1. Go to Appearance->Menus, click on 'create a new menu' and under 'Menu Settings' check the box next to 'Social Links Menu'.
	2. Add links for each of your professional social services using the 'Custom Links' panel located on the left side. For example:
	  A. LinkedIn - URL: http://linkedin.com/in/your-user-name - Link Text: LinkedIn
	3. After adding your professional social link to your menu, go to the top of the screen and click on 'Screen Options' and make sure 'Title Attribute' is checked.
	4. Once you have verified 'Title Attribute' has been checked, click on your link and in the 'Title Attribute' field enter the social link name using lowercase letters. For example:
	  A. LinkedIn - Title Attribute: linkedin
  5. After adding all of your professional social links to your menu, click on the 'Save Menu' button. 

  (Notice: This menu uses Font-Awesome icons via inputing the icon's name in the 'Title Attribute' field, so check the icon list at http://fontawesome.io/icons/ to verify the name.)
  
== Bundled Resources ==

* Foundation Framework 6.2.3 - MIT License (https://github.com/zurb/foundation/blob/master/LICENSE)
* Motion-UI 1.2.2 - MIT License (https://github.com/zurb/motion-ui/blob/master/LICENSE)
* What-Input 4.0.1 - MIT License (https://github.com/ten1seven/what-input/blob/master/LICENSE)
* Font-Awesome 4.6.3 - See all license for Font-Awesome (https://fortawesome.github.io/Font-Awesome/license/)

== External Resources ==

* Dosis by Impallari Type - Open Font License (https://fonts.google.com/specimen/Dosis)
* Open Sans by Steve Matteson - Apache License v2.0 (https://fonts.google.com/specimen/Open+Sans)
* jQuery 2.2.4 - MIT License (https://jquery.org/license/)

== Frequently Asked Questions ==

= Does this theme work with any plugins? =
On Point should work with most valid and non-destructive plugins, but depending on the plugin the styling might need to be adjusted for that plugin.
= Do I really need a sense of humor? =
No, not really, but it couldn’t hurt.

== Screenshots ==

Coming Soon! Until then, you can preview the theme at http://2-Drops.com

== Changelog ==

= 1.0 - Sep 28 2016 =
* Initial release

== Credits ==

* Underscores http://underscores.me/, (C) 2012-2016 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Foundation Framework 6.2.3 - MIT License (https://github.com/zurb/foundation/blob/master/LICENSE)
* Font-Awesome 4.6.3 - See all license for Font-Awesome https://fortawesome.github.io/Font-Awesome/license/
