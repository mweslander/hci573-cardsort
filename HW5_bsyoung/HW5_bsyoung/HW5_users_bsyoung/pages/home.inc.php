<?php //this page is useing a template set in its controller ?>
<div id="mainContent">
    <section id="errorMessage"></section>

    <section>
        <header>
            <h1>Welcome to my MVC framework!</h1>
        </header>
        <section>
            <p>
                This site has been built with PHP, MySQL, JQuery, Javascript, and basic Html.
                The architecture of the site follows the Model View Controller (MVC)design. Also, the site 
                is written in Object Oriented Programming to the best of my ability. While its far from perfect and I probably never
                will use it in production it was fun and extremely educational. 
                <br /><br />
                Building Process: This site implements PDO, and Mod Rewrite. Some of things I had a hard time with was: dynamic base urls, abstract classes, PDO,
                base urls in JQuery, Error Class, and understanding the relationship of the model and views. The initial bootstrap class checks if 
                database, tables, ect.. exist if so it creates what is need automatically. As of now it checks if the tables exists on every bootstrap, ideally I
                would take more time and figuring about a better installer, something that installs once and just checks a constant or writes a log to a text file that 
                gets check when the bootstrap starts. But it all takes time, so it is what it is.
                <br /><br />
                ISSUES: One issue that I haven't resolved was completing an error class to respond to the user when register was not successful.
                Currently, if registration was not successful it would stay on the registration page, once registration is successful you will be directed to the login page.
                While I have seen this done in Ajax, I wanted to make it completely in php, so if any user turns off javascript it will still work.
                However, at the current time, the site does check if a username already exist when registering a new user. User input on both pages, register
                and login are filtered and escaped so only clean data is entered into the database. 
               
               
            </p>
        </section>
    </section>
    <section>
        <header></header>
    </section>
</div>



