# forum-ace

As the repo name suggests, this app is a forum, a basic one actually. It serves as a forum between the students of a faculty (or more) and the companies active in the student's area of interest where the 'middle guy' is actually the app's admin (a teacher from the faculty, or plainly, the faculty itself). It's divised in two panels, a front and a admin/back one.

The back panel is accesible to both the admin and the companies. This doesn't mean that both types of users have the same rights. The admin, of course, has full rights over all data within the app, starting from approving new companies/students that are willing to sign up in the app to the removal of articles introduced by companies. On the other hand, the companies have rights only over their own articles.

The front panel is accesible, equally, to both students and companies. Here, students can follow the articles posted by companies based on certain filters (the most recent articles, the most popular ones, alike articles - that are marked with the same tags/categories as the ones that the students already saw). All the same, students can add comments on these articles. The comments sistem is a pretty complex one, where comments can be nested on three levels (comment->answer->answer over the initial answer) and also having a reviewing future (likes/dislikes can be added and because of these the comment will get up/down accordingly on the level/list in which exists).

As for the used technologies:

a) Front: HTML 5, CSS 3, JavaScript, jQuery 2.1 (along with a few built-on plugins such as datatables, timepicker, select2, slimscroll and many others), Bootstrap. Also, an existing WYSIWYG editor (Froala Editor) has been used for creating the articles in the back panel.

b) Back: PHP 7 and CodeIgniter 3.1.8. Regarding the code, a basic MVC design pattern has been used.

c) Database: relational (MySQL)
