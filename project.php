<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Overview</title>
    <!-- Linking CSS Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
</head>
<body>
    <main>
    <!-- Nav Bar -->
    <div class="nav">
        <a href="index.php">
            <img src="img/logo.jpg" alt="home">
        </a>
        <?php include 'includes/nav.php' ?>
    </div>
        <header>
            <h1>Project Overview: <br><span>La Conexión y el Futuro de las Aldeas Inteligentes</span></h1>
        </header>
        <div class="scroll">
            <h3>Project Overview:</h3>
            <ul> 
                <li><a href="#problem">The Problem ↓</a></li>
                <li><a href="#goal">Our Goal ↓</a></li>
                <li><a href="#stakeholders">Stakeholders ↓</a></li>
                <li><a href="#features">Features & Benefits ↓</a></li>
            </ul>
        </div>

        <article id="problem">
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
                <li><span>Project Requests:</span> This website is aimed to provide residents, administrators,
                    and other users with clear and regular updates on ongoing projects. Our client
                    highlighted his concern with our initial idea of having admin enter project details 
                    and maintain updates. We have adjusted accordingly, now allowing residents to submit
                    a request for managing project information that will be displayed on the website. 
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
            </ul>
        </article>
    </main>
    <?php include 'includes/footer.php' ?>
</body>
</html>