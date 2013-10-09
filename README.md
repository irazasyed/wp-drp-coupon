DRP Coupon - WordPress Plugin
=============================

### WordPress Plugin - DRP Coupon Mirror! ###

This is a mirror of DRP Coupon's WordPress Plugin which was removed recently for unknown reasons and was available at [http://wordpress.org/plugins/drp-coupon/](http://wordpress.org/plugins/drp-coupon/)

**Note:** I'm in no way, shape or form affiliated with the plugin or the developers of this plugin. Refer the plugin's license for more information about the permissions/rights or contact the plugin's developer on their official site - www.directresponsepublishing.com

---

**Contributors:** Direct Response Publishing

**Tags:** DRP Coupon, coupon, coupons, affiliate, links

**Requires at least:** `3.3.1`
**Tested up to:** `3.3.1`
**Stable tag:** `2.1`

DRP Coupon is a Wordpress Coupon Plugin which Allows You To Add Coupons that Expire or Don't Expire To Your Posts and Pages.

Description
-----------

DRP Coupon is a Wordpress Coupon Plugin which Allows You To Add Coupons that Expire To Your Posts and Pages. You can set your coupons to expire at the end of a certain date and they will disappear from your post or page or display a custom message like "no longer available". Add a regular link or an affiliate link from which the coupon will go to when clicked. A person cannot copy the code unless they click on the link. Once clicked it will copy the coupon code to the clipboard ready for easy pasting.

You can also set future dates for coupons to appear. So if a coupon starts in a week or 24hrs you can set the date, insert into post or page and the coupon will only appear when that start date arrives.

You can also have coupons with no expiry date so they are always viewable

Your url is masked, go ahead mouse over it and you won't see your affiliate link.

Installation
------------

1. Upload DRPCoupon directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the DRP Coupon Options on left to make create and manage coupons.

Frequently Asked Questions
--------------------------

**How to do you display it after you create a coupon?**

 To have it show in a page or post.  You have **2 options**

1. Clicking a button in your post or page ( see screenshot for location )
2. Using code into PHP like single.php ( only for advanced users ).


**How do i get just the coupon to show ( no title, description or expiry date )?**

- When you insert your coupon using the button, there are boxes - check 1 or all of them to exlude them from being seen

**How do I not have the coupon show in an RSS feed?**

- Just check the box to exclude it and it won't be seen in your RSS if you leave it unchecked it will.

**What is the Custom Expiry message field?**

- Some people wanted to not have the coupon disappear and instead have a message appear. This lets you do that. If you insert a message and save, when the coupon date expires the coupon will still be seen and you will also see your custom message. If you don't fill it then your coupon will disappear upon expiry like before.

**Is there a way to have coupons always seen, so that they never expire?**

- Yes, leave start date and expiry date blank, and leave the expiry message field blank and check the box for excluding expiry date when you insert

**Why don’t you hide the coupon code?**

- Simple, now days if you don’t show the coupon most people think you aren’t going to give a coupon and you just want them to click through on your affiliate link. So this bullcrap about that by hiding it you are going to get people to click through to get the coupon is crap, as people want you to be transparent. Look at any of the top coupon places online and you will see them displaying the coupon. We make sure people can’t copy it which is enough. There are many many so called coupon sites online that are NOT offering coupons they say click here but they are just using an affiliate link, this makes damn sure you are being upfront with your visitors. 


**Is this plugin free?**

- Yes. Which means don't expect a lot unless your willing to throw cash my way ;)

**Does the link require http:// or can i just put www.**

- You can put either one it works with both

**How can I see what it looks like before I activate it?**

- View the screenshots

Screenshots
-----------

1. Plugin admin panel `screenshot-1.png`

2. The place to insert coupon and options `screenshot-2.png`

3. The frontend once in post or page `screenshot-3.png`

Changelog
---------

**1.0**  

* Added to wordpress for everyone
* Visual change

**1.0.1**

* Fixed coupon not being copied to clipboard - works now


***2.0***

* Fixed problem where if ' was added in creating coupon it would show a \
* fixed issue with JQUERY sliders stopping after activation and functionality
* Added option to show just the coupon ( no title, description or expiry date ) or any combination you wish, by checking the box to exclude
* Added optional custom expiry message field - When filled in the msg appears when coupon date expires along with coupon, if its not filled in then coupon will disappear like before
* Added new and improved way to add coupons to post and page using a button. After creating your coupon you go to post or page and click button and select coupon to insert

***2.1***

* Added the option of having NO expiry ( you leave expiry field blank and expiry message blank and check expiry box when inserting )
* Added the option of future date coupons ( select a date in future, then insert into post and coupon displays when start date arrrives. The start date is based on the local time that is chosen in settings>general )
* Added the option of excluding the coupon from being seen in your RSS feed
* Made it compatible with the latest version of wordpresss
* Made it so you can SAVE a coupon with bare minimum of ( Name, Coupon Name, Link ) all the rest are optional
