=== AMP HTML Sitemap ===
Contributors: nmvdvjr
Tags: AMP, Accelerated Mobile Pages, sitemap 
Requires at least: 4.5.3
Tested up to: 4.6.1
Stable tag: 2.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Generates a customizable list of your AMP posts, pages and custom post types for SEO/indexing benefits, to be added to the content by shortcode.


== Description ==

An HTML sitemap is a list of names and links of your pages and posts in the front end of your website. It can be useful for users to get a good overview of the content you're presenting. For bots it is equally useful since the internal links send them to the farest corners of your website, which could help indexation greatly.

Strictly taken AMP does not need a sitemap (HTML or XML) if the content is marked up correctly: engines know where AMP content is by this piece of code present in your regular pages:

`<link rel="amphtml" href="https://www.example.com/url/to/amp/document.html">`



That being said there could be several reasons to use an AMP HTML Sitemap:

1. __You want your AMP content to be indexed faster and more regulary.__ In case you don't have much traffic, external links or good internal linking structure indexation could take a while. An HTML sitemap will improve your internal links and if you add the URL of the sitemap to your current XML sitemap plugin, search engines will gain information on the AMP content by automatic submission of your XML sitemap. (see 'Addditonal tips' under installation tab)

2. __You have 'stand alone' AMP content.__ Seen as there are no links pointing to content that is only reachable by AMP (because they miss the link from the regular page and naturally don't occur in menus) it can take a long time for them to be indexed.

3. __You have an HTML sitemap for regular content and simply wish to add your AMP content to it__


And in that case, this lightweight plugin is for you.


This plugin will not be supported, I will however try to answer all question in the comment section of the [plugin website](https://jaaadesign.nl/en/blog/amp-sitemap/) and create a FAQ.



__Matt Cutts on HTML and XML sitemaps__
[youtube https://www.youtube.com/watch?v=hi5DGOu1uA0]



== Installation ==

1. Upload en activate the plugin
2. Place the shortcode in a page or post: [amp-sitemap]

That's it!


Customizing the display of the AMP Sitemap plugin:

1. __append='amp'__ change the slug to point to your AMP verion. Depending on which AMP plugin you are using you can adjust the slug to direct to the AMP articles, standard: 'amp' (appropriate for the AMP plugin by Automatic). Example: __append='amp-post'__  will generate a slug 'yourwebsite.nl/post/__amp-post__/'

2. __heading='AMP'__ will add an H2 heading, standard: none
3. __max='5'__ will set a limit to the amount of posts displayed:, standard: 5000
4. __cpt1='page'__ NEW IN VERSION 2.0: support for 3 custom post types. Use the attributes ctp1='', cpt2='' and cpt3='' to add new post types such as page, product or any other. Standard: only posts. Note: only use this feature if your post type actually has an AMP version, or a series of 404's will be the result.
5. The shortcode can now look like this:

__[amp-sitemap append='amp' heading='AMP HTML Sitemap' max='20' cpt1='page' cpt2='portfolio']__


__Additional tips:__

* For regular indexing add the URL of your sitemap page to the sitemap plugin you use (we use Google XML Sitemaps): just copy/paste the URL in the plugin admin)

* You can also use this URL to add it manually to be indexed via Google Webmaster Tools (fetch as Google--> Submit).

Note: if the page containing the AMP sitemap is automatically submitted by a sitemap plugin, or regulary submitted manually to Google index there is no need to add it visibly to your website in navigation or blog pages. Of course it can never hurt ;-)


== Frequently Asked Questions ==

Perhaps soon.

== Changelog ==

= 1.0 =
Release date: July 4th, 2016

= 2.0 =
Release date: October 10th, 2016

* Added support for multiple (custom) post types
* Small adjustments to get cleaner code

== Upgrade Notice == 

== Screenshots == 

1. Links get the proper slug appended
1. Indexed fast and regulary __/webmasters/tools/accelerated-mobile-pages/__