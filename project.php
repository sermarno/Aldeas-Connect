<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Overview</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
    <!-- GOOGLE FONTS: Menu Icon -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <!-- GOOGLE FONTS: Typeface -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alumni+Sans+Pinstripe:ital@0;1&display=swap" rel="stylesheet">
    <!-- Translate API -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }       
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        function translatePage() {
            var translateElement = document.getElementById('google_translate_element');
            translateElement.style.display = 'block';
            var select = translateElement.querySelector('select');
            select.value = 'es';
            select.dispatchEvent(new Event('change'));
        }
    </script>
</head>
<body>
    <!-- Nav Bar -->
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/side_nav.php' ?>

    <div id="project-page">
        <header>
            <h1>The Problem & Our Purpose</h1>
        </header>

        <article id="problem">
            <img src="img/questionaire.jpeg" alt="questionaire">
            <h3>The Problem</h3>
            <p>
                Aldeas Inteligentes, Bienestar Sostenible is a Mexican Federal 
                Government project actively working to provide digital access 
                to rural and isolated communities across Mexico. Having already 
                connected 83 communities, this project provides community residents 
                with a range of wireless internet connection methods, STEM training, 
                and support in community development projects aimed towards improving 
                education, commerce, health, welfare, and other developmental aspects. 
                <br><br>
                Currently, administrators rely on project updates through a questionnaire 
                completed by residents once every three months, but with long gaps between 
                check-ins and no effective communication tool, it is challenging to maintain 
                contact with the residents and ensure that the projects are receiving the 
                attention they need for their completion. If there isn’t an effective tool 
                to frequently track the status of community projects and reach out to community 
                members, residents miss opportunities to gain recognition for their work, inspire 
                greater involvement, and secure additional funding or support for their community 
                development.
            </p>
        </article>
        <article id="goal">
            <h3>Our Goal</h3>
            <p>
                Our goal as a team is to create an information system that manages 
                Smart Village operations, enabling communities to showcase their projects on an 
                official website and to stay in contact with curators for assistance, encouraging 
                greater participation and ultimately increasing their potential for further development. 
                Including a visualization of community projects enhances transparency through a clear way 
                for the public to see what projects are being worked on through the provided technology
                and assistance. By providing administrators and residents a communication tool directly through
                the website, users can get immediate responses to their concerns or questions.
            </p>
        </article>
        <article id="stakeholders">
            <h3>Stakeholders</h3>
            <ul>
                <li><span>Rural Community Residents</span> - these individuals are the focus group for this
                    project.</li>
                <li><span>Administrators/Staff</span> - this includes administrators, developers, and 
                    any other individuals who work behind the scenes to support the residents.</li>
                <li><span>Site Visitors</span> - this includes any visitors of the website who are looking at what
                    the site has to offer.</li>
                <li><span>Smart Village Affiliates</span> - this website can stand as an inspiration for individuals who 
                    are working with Smart Villages in other locations to provide connectivity to rural communities.</li>
                <li><span>Potential Investors</span> - as this website offers transparency of Smart Village operations, 
                    it may attract individuals who wish to support the residents in other ways. </li>
            </ul>
        </article>
        <article id="features">
            <h3>Features and Benefits</h3>
            <ul>
                <li><span>Clear Project Updates:</span> This website is aimed to provide residents, administrators,
                    and other users with clear and regular updates on ongoing projects. Our client
                    expressed that he would like to be able to update project and community details as they change, as well
                    as be able to add new projects and communities to the website.
                </li>
                <li><span>Messaging System:</span> Administrators shared their main challenges with communicating with 
                    residents of rural and isolated areas who utilize Smart Villages. One specifically 
                    reported that his role involves coordinating with local leaders, analyzing project 
                    progress, and ensuring that resources and support are allocated effectively. As many 
                    residents often have quick inquiries and problems regarding their community projects, 
                    it is important to provide a better communication method that doesn’t solely rely on 
                    ineffective check-ins. This communication tool could facilitate communication between 
                    community members and administrators, providing more clear feedback and offering responses 
                    to emerging issues.
                </li>
                <li><span>Map of Mexico:</span> This feature provides users with a clear visualization of where the 
                    communities who are utilizing Smart Villages are in Mexico. Clicking on each map marker will 
                    direct the users to a page that examines the community further. </li>
                <li><span>Dynamic About Page</span> As aspects of the Smart Village project changes, our client shared his
                    concern for not being able to change content himself. Our about page, as well as several other pages
                    have been constructed so that administrators who are logged in can change a great amount of content. </li>
                <li><span>Translation</span> Because our project's target audience focuses on individuals who's primary language
                    is Spanish, we wanted to ensure that users can quickly translate any of the text on our website.</li>
            </ul>
        </article>
    <script src="js/nav.js"></script>
    </div>
    <div class="translate-container">
        <div id="google_translate_element" class="translate-box"></div>
        <img src="img/translate_icon.png" alt="Translate" class="translate-icon">
        </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>