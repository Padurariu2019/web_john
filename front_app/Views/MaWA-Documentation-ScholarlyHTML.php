<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MaWA Documentation</title>
    <link rel="stylesheet" href="assets/css/documentation_style.css">
</head>
<body>
    <header>
        <h1>Make-up Web Assistant - Documentation</h1>
        <p>Documentation in accordance with the IEEE System Requirements Specification and the Scholarly HTML format.</p>
        <p>Authors: <b>Ciorâțanu Maria</b>, <b>Pâncă Aida-Gabriela</b>, year II, group A5</p>
        <p>Date: April 2024</p>
    </header>

    <article>
        <section id="abstract">
            <h2>Abstract</h2>
            <p>The purpose of this document is to describe the functionalities and design considerations of the MaWA application. It lists the main requirements, functionalities and various cases of user interaction. It also presents the technologies used and the motivation behind choosing them.</p>
        </section>        
        <section id="introduction">
            <h2>1. Introduction</h2>
            <h3>1.1 Purpose</h3>
            <p>MaWA (Make-up Web Assistant) is a web application designed to provide personalized makeup and skincare advice. The primary objective of MaWA is to offer tailored product recommendations and guidance based on individual user preferences and characteristics such as age, skin type, occasion and time of day. The application aims to assist users in their makeup and skincare routines, ensuring each user receives advice suited to their specific needs.</p>
            <h3>1.2 Document Conventions</h3>
            <p>This document is formatted according to the IEEE SRS guidelines, using HTML5 and CSS for clear structuring and easy navigation.</p>
            <h3>1.3 Product Scope</h3>
            <p>The MaWA project aims to enhance the user's experience in selecting makeup and skincare products through an automated, personalized advisory system accessible via a web interface. The motivation behind MaWA stems from the common challenge many people face: the difficulty in selecting appropriate cosmetics and makeup products. Many individuals lack the knowledge to choose products that are safe and suitable for their needs, navigating through an overwhelming amount of options. MaWA addresses this issue by providing easy-to-access, user-friendly, and personalized advice, ensuring users receive accurate information tailored to their specific requirements. </p>
            <h3>1.4 Intended Audience and Reading Suggestions</h3>
            <p>MaWA targets both beginners and professionals in makeup, but primarily focuses on novices who are new to the world of cosmetics. The website allows the user to make an account and then browse through the available questions in order to receive personalized advice. It also displays charts and rankings with the most popular make-up products sorted by age, area, gender and social status.</p>
            <h3>1.5 References</h3>
            <p>References to technologies used, previous documentation, and related resources are listed at the end of this document in the Bibliography section.</p>
        </section>

        <section id="overall-description">
            <h2>2. Overall Description</h2>
            <h3>2.1 Product Perspective</h3>
            <p>MaWA (Make-up Web Assistant) is a web-based product designed to offer makeup and skincare advice tailored to individual preferences and needs. MaWA utilizes its own extensive database, which includes a wide variety of products from various companies and pre-defined advice for each combination of user preferences. This allows for more controlled updates and management of the content provided to users. The system uses an algorithm to analyze user inputs and recommend products and advice directly from its internal database.</p>
            <h3>2.2 Product Functions</h3>
            <ul>
                <li>User registration and authentication.</li>
                <li>Personalized makeup and skincare advice based on user input.</li>
                <li>Product recommendations from a variety of brands.</li>
                <li>Ability to save favorite products.</li>
                <li>Downloadable reports on product popularity.</li>
                <li>Ability to ask questions and contact the team.</li>
            </ul>
            <h3>2.3 User Classes and Characteristics</h3>
            <p>The platform is designed to be accessible and beneficial to anyone interested in makeup and skincare, regardless of their expertise level(beginners/make-up artists).</p>
            <p>Beginners are expected to be the most frequent users of the application. This group includes individuals who lack extensive knowledge or experience in the domain of makeup and skincare. They typically have limited access to personalized beauty advice and may not be familiar with the variety of products available.</p>
            <p>Advanced users, while not the primary target, can still find value in the application through its comprehensive database of products and the ability to discover new items and trends. However, the interface and functionality are designed to be uniform across all user levels, ensuring a cohesive and straightforward experience for everyone.</p>
            <h3>2.4 User Documentation</h3>
            <p>User documentation will include an interactive online help system, categorised themed questions and a detailed tutorial on how the website works.</p>
        </section>
        
        <section id="external-interface-requirements">
            <h2>3. External Interface Requirements</h2>
            <section id="user-interfaces">
                <h3>3.1 User Interfaces</h3>
                <p>The website provides a responsive user interface suitable for various devices and screen sizes.</p>
                <p>The header of the application contains navigational elements that are present on every page except the Sign Up and Sign In pages. It includes:</p>
                <ul>
                    <li>Menu: Access to additional resources and support pages.</li>
                    <li>Buttons: Functional buttons for the Cosmetics/Skin switch, which allow users to toggle between cosmetic and skincare advice.</li>
                    <li>Account: Quick access to user account settings and details.</li>
                    <li>Search: A search bar for finding specific products or advice within the application.</li>
                    <li>Favorites: A link to the user’s favorite products and rankings of popular products.</li>
                </ul>
                <img src="assets/images/page4.jpeg" alt="descriere">
                <p>The menu provides links to several informational and support pages:</p>
                <ul>
                    <li>Contact: Page where users can find contact information and reach out for further assistance.</li>
                    <li>Help: Includes Frequently Asked Questions and other resources to help users navigate and utilize the application effectively.</li>
                    <li>About: Provides background information on the application, its purposes, and about us.</li>    
                </ul>
                <img src="assets/images/page5.jpeg" alt="descriere">
        </section>
            <section id="hardware-interfaces">
                <h3>3.2 Hardware Interfaces</h3>
                <p>Since this is a web-based application, the primary hardware interfaces are through standard computing and mobile devices:</p>
                <ul>
                    <li>Devices Supported: Desktop computers, laptops, tablets, and smartphones.</li>
                    <li>Data Interactions: Interaction with the hardware is primarily through input devices like keyboards, mice, and touchscreens for mobile devices.</li>
                </ul>
            </section>
            <section id="software-interfaces">
                <h3>3.3 Software Interfaces</h3>
                <p>The website interacts with several software components:</p>
                <ul>
                    <li>Web Browsers: Google Chrome, Mozilla Firefox, Safari, and Microsoft Edge.</li>
                    <li>Backend Database: MySQL Database for storing user profiles, product information, and preferences.</li>
                    <li>Communication Protocols: HTTP(S) for secure web access, RESTful APIs for backend communication.</li>
                </ul>
                <p>Data exchange is conducted via JSON for API interactions, ensuring smooth data flow between frontend and backend systems.</p>
            </section>
            <section id="communications-interfaces">
                <h3>3.4 Communications Interfaces</h3>
                <p>The application uses various communication standards and protocols to enhance user interaction and data security:</p>
                <ul>
                    <li>Email Integration: For user registration, password resets, and notifications.</li>
                    <li>Network Protocols: HTTP and HTTPS for all web traffic, WebSocket for real-time user notifications.</li>
                </ul>
            </section>
        </section>

        <section id="system-features">
            <h2>4. System Features</h2>
            <p>MaWA is an advanced platform specifically designed for beauty enthusiasts who are interested in makeup and skincare. It provides comprehensive functionalities that not only help users to learn about various products but also allow them to receive personalized advice based on their preferences, and to contribute by adding their favorite products. The most important elements of the website are:</p>
            <ul>
                <li>SignUp</li>
                <li>SignIn</li>
                <li>Cosmetics/Skin page</li>
                <li>Recommendations</li>
                <li>Products</li>
                <li>Favourites</li>
                <li>Account</li>
                <li>Admin</li>
                <li>Contact</li>
                <li>Help</li>
                <li>About</li>
                <li>Navigation Bar</li>
            </ul>            
            <section id="feature-signup">
                <h3>4.1 Sign Up</h3>
                <p>The first page the user sees is the Sign Up page where you create an account the first time you visit the website. Here, the user will create an account by entering the following details: Name, Email, Password, Gender, City, Social Status. After filling out all the form, they will click the SignUp button and will be redirected to the Cosmetics page.</p>
                <img src="assets/images/page1.jpeg" alt="descriere">
            </section>
        
            <section id="feature-signin">
                <h3>4.2 Sign In</h3>
                <p>If the user already has an account, they will click on "Sign in" button from the text "Already have an account? Sign in" and will be redirected to the Sign In page, where they will only need to enter their Email and Password. Then, they will press the SignIn button and will be redirected to the Cosmetics page.</p>
                <img src="assets/images/page12.jpeg" alt="descriere">
            </section>
        
            <section id="feature-cosmetics-skin-navigation">
                <h3>4.3 Cosmetics/Skin Pages</h3>
                <p>The Cosmetics page is similar to the Skin page. There is a button at the top labeled “Cosmetics/Skin” that users can click on according to their needs. If they want advice on makeup application, they press Cosmetics; if they're looking for skincare advice, they press Skin. Thus, these two pages offer the same functionalities tailored to the user's needs and preferences. Depending on what the user is looking for, they will navigate through the exact same pages and follow the same journey whether they select Cosmetics or Skin. However, the outcomes will be specific to the chosen domain, offering advice on makeup or skincare accordingly.</p>
                <img src="assets/images/page6.jpeg" alt="descriere">
            </section>
        
            <section id="feature-preferences-selection">
                <h3>4.4 Preferences Selection</h3>
                <p>On both Cosmetics and Skin Care pages, the user sees the criteria they can choose to receive advice and recommendations for cosmetic products. The user selects the categories they are interested in, based on their preferences or where they fit. The criteria are: age, skin type, occasion, and time of day. Selection is made by checking a box next to the desired option. After selecting an option for all the given criteria, the user will press the "Save" button and will be redirected to the Advice page, where they will receive the relevant advice.</p>
                <img src="assets/images/page7.jpeg" alt="descriere">
            </section>
        
            <section id="feature-personalized-advice">
                <h3>4.5 Personalized Advice (Recommendations)</h3>
                <p>Following preferences selection, users are directed to the Advice page where they receive personalized recommendations. The system analyzes user choices to present the most relevant advice, tips and an example of how the makeup might turn out.</p>
                <img src="assets/images/page8.jpeg" alt="descriere">
            </section>
        
            <section id="feature-product-recommendations">
                <h3>4.6 Products</h3>
                <p>The Products page displays items based on the user's preferences. When the user clicks on the "View Products" button, they will be redirected to the Products page, where they will see all the products that are suitable based on the selected criteria and preferences. The user will receive products for each necessary step in makeup application, and these products will come from various brands. They can add products to their favorites and view them anytime by accessing the Favorites page (indicated by a heart icon in the menu bar). Each product includes a description, the name of the brand, the name of the product.</p>
                <img src="assets/images/page9.jpeg" alt="descriere">
            </section>
        
            <section id="feature-favorites-management">
                <h3>4.7 Favorites</h3>
                <p>Users can manage their favorite products in a dedicated Favorites page, which also surfaces popular items and offers downloadable reports(in the following formats: HTML, RSS, PDF) for insight into popular trends based on age, gender, social status and city.</p>
                <img src="assets/images/page2.jpeg" alt="descriere">
            </section>
        
            <section id="feature-user-account-management">
                <h3>4.8 Account - User Account Management</h3>
                <p>Within the Account page, users can view and edit their personal information and manage their preferences, ensuring full control over their account settings.</p>
                <img src="assets/images/page10.jpeg" alt="descriere">
            </section>
        
            <section id="feature-admin-controls">
                <h3>4.9 Admin</h3>
                <p>The Admin page provides administrators with tools to manage user accounts, add or update product listings, approve operations, and maintain the overall health of the platform.</p>
            </section>
        
            <section id="feature-contact-information">
                <h3>4.10 Contact</h3>
                <p>The Contact page includes comprehensive details for user support, including social media links, email addresses, phone numbers, an adress where we can be found (Faculty of Informatics, Iași), pictures of us and a direct messaging feature for inquiries.</p>
                <img src="assets/images/page13.jpeg" alt="descriere">
            </section>
        
            <section id="feature-help-faq">
                <h3>4.11 Help</h3>
                <p>A Help section with a FAQ provides immediate answers to common questions, reducing the need for direct support and empowering users to find information independently. If the question is too specific, you have the option to send a direct message and an answer will be provided in a few hours. At the same time, the questions are devided into categories based on specific themes, so the user can select which theme their question belongs to.</p>
            </section>
        
            <section id="feature-about-platform">
                <h3>4.12 About</h3>
                <p>The About page outlines the mission, vision, and values of the platform, providing users with a background on the platform's goals and  how it works.</p>
                <img src="assets/images/page11.jpeg" alt="descriere">
            </section>

            <section id="feature-about-navbar">
                <h3>4.13 Navigation Bar</h3>
                <p>The website navigation bar remains consistent across all pages, featuring a straightforward menu that facilitates simple navigation for the user. The menu contains buttons that lead to different parts of the website (Contact, Help, About, Products, Admin, LogOut). It is very responsive.</p>
            </section>
        </section>

        <section id="user-interface-design">
            <h2>5. User Interface Design</h2>
            <p>Although we devoted additional time to the design of each page, given that each one features a distinct design, this was an important aspect for us. As we are passionate about art, we wanted the website to stand out, and we tried to avoid simplicity in favor of a more unique user experience.</p>
            <p>The web interface of our website is designed to be user-friendly. Each page has a distinctive color scheme that aligns with the theme of the products and content presented, avoiding monotony and engaging the user visually. The layout utilizes vibrant colors and high-quality images of cosmetic products and makeup styles to help the user understand the vision better. The use of images not only reflects the diversity of our product recommendations but also guides the user's journey.</p>
            <p>The interface is structured to facilitate easy navigation with prominent features such as a toggle switch for Cosmetics and Skin sections, a clear and accessible account login area, and a favorites section represented by a heart icon. Search functionality is integrated into the header, ensuring that users can quickly find products or information. The navigation menu has modern design conventions.</p>
            <p>The 'Preferences' section in particular helps the users to select personal criteria such as age, skin type, occasion, and time of day.</p>
            <p>The responsiveness of the design is tested to ensure compatibility with a wide range of devices, from desktop computers to mobile phones, providing a consistent experience across all platforms. </p>
        </section>

        <section id="used-technologies">
            <h2>6. Used Technologies</h2>
            <p>To make the frontend component of this website, we used:</p>
            <ul>
                <li>HTML5</li>
                <li>CSS</li>
            </ul>
            <p>The web application interface is implemented in HTML5, and the code has been verified and is valid according to the World Wide Web Consortium (W3C) specifications. The CSS style sheets are valid and were checked using Stylelint.</p>
        </section>

        <footer>
            <h2 class="centered-title">Bibliography</h2>
            <p>Below are the references used in the preparation of this documentation:</p>
            <ul>
                <li>IEEE System Requirements Specification Template: <a href="https://github.com/rick4470/IEEE-SRS-Tempate#readme">https://github.com/rick4470/IEEE-SRS-Tempate#readme</a></li>
                <li>Scholarly HTML Template: <a href="https://w3c.github.io/scholarly-html/">https://w3c.github.io/scholarly-html/</a></li>
                <li>Web Technologies website: <a href="https://edu.info.uaic.ro/web-technologies/web-projects.html">https://edu.info.uaic.ro/web-technologies/web-projects.html</a></li>
                <li>Seminar website: <a href="https://tehnologii-web.vercel.app/">https://tehnologii-web.vercel.app/</a></li>
                <li>Examples: <a href="https://github.com/">https://github.com/</a></li>
                <li>Solving specific errors: <a href="https://stackoverflow.com/">https://stackoverflow.com/</a></li>
                <li>Pictures of make-up products: <a href="https://ro.pinterest.com/">https://ro.pinterest.com/</a></li>
                <li>Color palettes: <a href="https://visme.co/blog/website-color-schemes/">https://visme.co/blog/website-color-schemes/</a></li>
                <li>HTML: <a href="https://youtu.be/mJgBOIoGihA?si=vkrH64siPct1Z4Ht">https://youtu.be/mJgBOIoGihA?si=vkrH64siPct1Z4Ht</a></li>
                <li>CSS: <a href="https://youtu.be/n4R2E7O-Ngo?si=q9jxF5bgTOtqhUVy"> https://youtu.be/n4R2E7O-Ngo?si=q9jxF5bgTOtqhUVy</a></li>
                <li>HTML validator: <a href="https://validator.w3.org/"> https://validator.w3.org/</a></li>
                <li>CSS validator: <a href="https://jigsaw.w3.org/css-validator/"> https://jigsaw.w3.org/css-validator/</a></li>
            </ul>
        </footer>
    </article>
</body>
</html>
