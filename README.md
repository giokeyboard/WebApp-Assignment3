# WebApp-Assignment3
Small website (HTML, CSS, PHP) for a "Web Application Development" course assignment 

This package consists of 7 PHP webpages and 1 style sheet:
*	header.php: PHP header loaded in every single page of the bundle with links to home (index), offices, payments
*	footer.php: PHP footer loaded in every single page of the bundle showing detailed information about the company
*	index.php: company’s landing page, showing a table with main products
*	offices.php: shows company’s offices in a table
*	officextra.php: shows employee information for company’s offices around the world
*	payments.php: shows payments from customers, allows the user to show first 20, 40 or 60 entries with a dropdown menu
*	paymentinfo.php: clickable from each customer id in payments page, shows detailed information for single customers as long as their payment history
*	classicmodels.css: style sheets containing css code for all the pages

No Javascript has been used in any page, as I chose to focus mostly on PHP development as it is a whole new language for me.

The layout of the website is as lean and simple as possible.

The technique I used to transfer information (for instance, customer id) between two pages is sending some data to the destination page URL and then getting it by means of the GET method in the PHP code of such “destination” page.

Disclaimer: I personally didn’t know about this method which I find very handy; a classmate showed me how to use it so credits for that go to Avik Saha.
