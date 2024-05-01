-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 07:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydreamblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `title`, `image`, `description`) VALUES
(5, 'Art Extravaganza', 'img/Art Supplies Extravaganza.jpg', 'Calling all art enthusiasts and creators! Get ready to unlock your full artistic potential at our exclusive Art Supplies Extravaganza! Immerse yourself in a world of creativity and bring your imagination to life with our handpicked selection of high-quality art supplies.\r\n\r\nDiscover Premium Quality: Elevate your artwork with our top-notch acrylic paints, watercolor sets, and more, sourced from trusted brands renowned for their exceptional quality.\r\n\r\nUnearth a Spectrum of Brushes: Choose from a diverse range of brushes tailored to suit your unique artistic style, whether you prefer fine detailing or bold, expressive strokes.\r\n\r\nExplore Mixed Media: Embrace the endless possibilities of mixed media art with our comprehensive range of materials, including textured canvases and charcoal pencils.\r\n\r\nExclusive Deals Await: Don\'t miss out on irresistible deals and special discounts during our Art Supplies Extravaganza. We believe that every artist deserves to have the best tools without breaking the bank!\r\n\r\nFree Gift with Purchase: As a token of appreciation, enjoy a complimentary art-related gift with every purchase made during this event.\r\n\r\nLimited Time Offer: The Art Supplies Extravaganza is a one-of-a-kind opportunity that won\'t last forever. Act now to fuel your creativity and take advantage of these fantastic offers.\r\n\r\nConvenient and Fast Shipping: We deliver right to your doorstep, ensuring a seamless and hassle-free shopping experience, so you can focus on unleashing your creativity.'),
(6, 'Supercharge Your Web Development Skills with Our Python Flask Masterclass', 'img/Flask-in-Python.jpg', 'Are you eager to build powerful and scalable web applications using Python\'s Flask framework? Look no further! Join our immersive online course where you\'ll explore Flask\'s core features, from routing and views to database integration and RESTful APIs. Unlock the potential of Flask with hands-on projects, guided by industry experts, and gain the confidence to create robust web apps.\r\n\r\nEnroll now and embrace the elegance and power of Flask in your web development journey. Don\'t miss this opportunity to become a Flask expert! Limited seats available.\"');

-- --------------------------------------------------------

--
-- Table structure for table `buying`
--

CREATE TABLE `buying` (
  `id` int(20) NOT NULL,
  `ad_id` int(20) DEFAULT NULL,
  `user_id` int(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buying`
--

INSERT INTO `buying` (`id`, `ad_id`, `user_id`, `message`, `response`, `date`) VALUES
(3, 6, 38, 'What are the prerequisites for the course? Are there any specific programming languages or skills I should be familiar with before enrolling?', ' The course requires a basic understanding of Python programming. Familiarity with HTML, CSS, and web development concepts will be beneficial but not mandatory.', '2023-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(18, 'Programming'),
(21, 'bootstrap'),
(22, 'Game development'),
(23, 'Backend development'),
(24, 'Database');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(20) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `post_id` int(20) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` int(10) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `status`) VALUES
(2, 34, 11, 'this is good', 1),
(3, 37, 11, 'Awesome', 1),
(4, 38, 21, 'This blog post provides a comprehensive overview of Flask', 1),
(5, 39, 21, ' A well-written and informative blog post that successfully highlights Flask\'s strengths and benefits.', 1),
(6, 39, 20, 'The blog post provides valuable tips and best practices for writing efficient SQL queries.', 1),
(7, 39, 20, 'very informative', 1),
(8, 40, 19, 'The blog post effectively highlights the significance of responsive web design.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(20) NOT NULL,
  `category_id` int(20) DEFAULT NULL,
  `posted_by` int(20) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `posted_by`, `title`, `image`, `tags`, `description`, `date`, `status`) VALUES
(11, 15, 34, 'Exploring the World of Art', 'images/art-contest.jpg', 'world, art, article', 'Welcome to \"Brushstrokes of Inspiration,\" an art blog dedicated to unlocking the vast realm of creativity and artistic expression. Whether you\'re an avid art enthusiast, an aspiring artist seeking inspiration, or simply curious about the captivating world of art, this blog is your gateway to a diverse and colorful journey.\r\n\r\nDelve into the works of renowned masters and emerging talents across various art forms, from timeless classics to contemporary creations. Discover the stories behind iconic paintings, sculptures, and installations, and explore the cultural, historical, and emotional significance they carry.\r\n\r\nUncover the techniques and secrets that artists employ to breathe life into their visions. From exploring the intricacies of oil painting to the beauty of intricate pencil sketches, we\'ll unravel the tools and methods that shape art\'s mesmerizing tapestry.\r\n\r\nJoin us in celebrating the wonders of artistic expression as we showcase artists from different cultures and backgrounds, shedding light on the transformative power of art in our lives. Whether you seek artistic insights, thought-provoking discussions, or simply wish to immerse yourself in beauty, \"Brushstrokes of Inspiration\" invites you to embark on an unforgettable odyssey through the boundless world of art. Let your creativity soar as we paint vivid strokes of inspiration together.', '2023-07-24', 1),
(17, 18, 35, 'Concepts Every Developer Should Know', 'images/nweeqf97l2md3tlqkjyt.jpg', '#html #programming', 'Programming is an ever-changing field, and for developers, keeping up with essential programming concepts is vital. Whether you\'re a seasoned coder or just starting, understanding foundational concepts lays the groundwork for successful coding. In this blog post, we will delve into ten indispensable programming concepts that every developer should know. Variables and Data Types Variables play a fundamental role as they store data values. Understanding data types, such as integers, strings, and floats, and properly declaring variables is essential for creating robust applications. Control Structures Control structures, like if-else statements and loops, offer decision-making capabilities and repetition, enabling developers to control program flow effectively. Functions and Methods Functions and methods are reusable code blocks performing specific tasks. Learning how to create and call functions promotes modular and organized code. Object-Oriented Programming (OOP) OOP is a pivotal paradigm organizing code into objects with properties and behaviors. Comprehending OOP principles, such as encapsulation, inheritance, and polymorphism, facilitates scalable and maintainable code. Exception Handling Exception handling allows developers to gracefully manage errors and unexpected situations, enhancing user experience and preventing crashes. Data Structures Data structures, like arrays and dictionaries, efficiently organize and manage data. Knowing when and how to use them is critical for tackling complex problems. Algorithms Algorithms are step-by-step procedures for problem-solving. Proficiency in algorithms enables developers to write optimized and efficient code. File Input/Output (I/O) Proficient file I/O skills are essential for applications needing to persist data or interact with users via files. Debugging and Testing Debugging techniques and writing effective tests are crucial for identifying and resolving issues early in the development process. Version Control Version control, using systems like Git, tracks code changes over time, enabling collaborative development and simplifying project management. Conclusion In conclusion, these ten essential programming concepts form the bedrock of every developer\'s skillset, empowering them to excel in the ever-evolving world of coding. Mastery in these areas requires consistent practice, continuous learning, and openness to exploring new technologies. Remember that coding is not just about writing lines of code; it\'s about problem-solving, creativity, and building impactful solutions. Embrace challenges, view mistakes as opportunities to learn, and continuously refactor code to keep it clean and maintainable. Stay updated with industry trends, engage with coding communities, and seek mentorship from experienced professionals. With dedication, passion, and a willingness to learn, you can become a proficient developer and make a positive impact in the tech world. So, take a deep breath, embrace coding challenges, and enjoy the journey of growth and continuous.', '2023-07-31', 1),
(18, 23, 35, 'The Key to Solving Complex Problems', 'images/images (1).jpg', '#html #programming #frontend', 'In the fast-paced and ever-evolving world we live in, complex problems are becoming increasingly common. Whether you\'re a student, a professional, or an entrepreneur, you\'ll encounter challenges that seem daunting and difficult to overcome. However, the ability to solve complex problems is a valuable skill that can set you apart and lead to personal and professional growth. In this blog post, we will explore the key strategies and approaches to tackle complex problems effectively. Understanding the Problem The first step in solving any complex problem is to thoroughly understand it. Take the time to define the problem clearly and identify its underlying causes. Break down the problem into smaller components and analyze each part to gain insights into the overall challenge. Gather Information and Research Knowledge is power when it comes to problem-solving. Conduct in-depth research, gather data, and seek information from credible sources related to the problem at hand. Embrace diverse perspectives and learn from the experiences of others who have faced similar challenges. Think Creatively and Outside the Box Complex problems often require creative solutions. Embrace creativity and think outside the box. Brainstorm with a team or on your own to generate innovative ideas and approaches to tackle the issue from different angles. Develop a Step-by-Step Plan Formulate a well-structured plan to address the problem. Break down the solution into achievable steps, setting milestones and deadlines to track progress. A systematic approach will help you stay organized and focused throughout the problem-solving process. Collaborate and Seek Input Complex problems can benefit from collaborative efforts. Engage with others who can contribute diverse skills and expertise to the solution. Seek feedback and input from team members or mentors to refine your approach further. Test and Iterate Implement your proposed solution and evaluate its effectiveness. Be open to making adjustments as needed based on the results.\r\n\r\n', '2023-08-01', 1),
(19, 18, 35, 'Building Responsive Web Apps with React.js', 'images/React-Native-Web-development-min.png', '#html #programming #frontend', 'In today\'s digital age, building responsive web applications is a fundamental requirement to ensure a seamless user experience across various devices and screen sizes. React.js, a powerful and popular JavaScript library, provides the perfect foundation for creating dynamic and responsive web apps. In this blog post, we will explore the key principles and techniques of building responsive web applications using React.js. Understanding Responsive Web Design Responsive web design is an approach that aims to create web applications that adapt and adjust their layout based on the user\'s device, such as desktops, tablets, or smartphones. This ensures that the app looks and functions well, regardless of the screen size. By embracing responsive web design principles, developers can cater to a diverse user base and improve engagement and usability. Mobile-First Approach A mobile-first approach involves designing and developing web applications with mobile devices in mind as the primary target. By starting with the mobile view and then progressively enhancing the layout for larger screens, developers can create applications that are lightweight, fast, and user-friendly on smartphones and tablets. Responsive Layouts with Flexbox and Grid React.js allows developers to implement responsive layouts using Flexbox and CSS Grid. These modern CSS layout tools provide flexible and efficient ways to structure components, enabling dynamic repositioning and resizing based on the available screen space. By leveraging these features, developers can build responsive designs that adapt seamlessly to different devices. Media Queries Media queries are CSS features that enable developers to apply styles based on the device\'s characteristics, such as screen size, resolution, or orientation. Utilizing media queries in combination with React.js components allows developers to create device-specific layouts and optimize the user experience for each device type. Responsive Images and Assets In a responsive web app, optimizing images and assets is crucial for reducing load times and improving performance. React.js, combined with tools like responsive image libraries and lazy loading, enables developers to serve appropriately sized images based on the user\'s device, conserving bandwidth and enhancing loading speeds. Handling Touch and Gestures Mobile devices rely heavily on touch and gestures for user interactions. React.js offers touch event handling capabilities, enabling developers to create touch-friendly UI components and provide an intuitive and responsive user experience on touch-enabled devices. Testing for Responsiveness To ensure a smooth user experience across different devices and screen sizes, thorough testing is essential. Developers can use various browser testing tools, responsive design testing tools, and device simulators to check the app\'s responsiveness and identify any issues that need addressing. Conclusion Building responsive web applications with React.js is a rewarding experience that empowers developers to deliver high-quality user experiences to a diverse audience. By embracing responsive web design principles, employing mobile-first approaches, and leveraging the capabilities of React.js, developers can create applications that look and function seamlessly on all devices. Remember that responsiveness is not just about layout adjustments; it\'s also about optimizing performance, minimizing load times, and providing a delightful user experience. So, start exploring the world of responsive web app development with React.js, and unlock the potential to build dynamic and user-friendly applications for the web!', '2023-08-01', 1),
(20, 24, 35, 'Writing Efficient SQL Queries for Database', 'images/download (2).png', '#database #mysql', 'In the world of software development, efficient database performance is critical for applications to deliver seamless user experiences and handle large amounts of data effectively. SQL (Structured Query Language) is the primary language used to interact with databases, and writing efficient SQL queries is key to achieving optimal database performance. In this blog post, we will explore essential tips and best practices to help you write efficient SQL queries and boost your application\'s database performance. Understand Your Data and Query Requirements: Before writing any SQL query, take the time to thoroughly understand your data and the specific requirements of the query. Identify the exact data you need to retrieve or manipulate to avoid unnecessary data fetching or processing, which can lead to performance bottlenecks. Use Indexes Wisely: Indexes play a vital role in improving query performance. Properly indexed columns can significantly speed up data retrieval. However, avoid over-indexing, as it may slow down data modification operations. Regularly monitor and update the indexes based on the application\'s changing needs. Avoid SELECT *: Instead of using \"SELECT *,\" explicitly list the columns you need in the query. This practice reduces the amount of data retrieved from the database, making the query more efficient. Limit the Use of Subqueries: While subqueries can be useful, they can also be resource-intensive. Whenever possible, try to rewrite subqueries as JOINs or use temporary tables to improve query performance. Optimize JOINs: Be mindful of how you use JOIN operations in your queries. Ensure that you have appropriate indexes on the columns used in JOIN conditions and use the appropriate JOIN type (INNER JOIN, LEFT JOIN, etc.) depending on your data needs. Minimize Data Manipulation in Queries: Performing data manipulation tasks (e.g., calculations, string manipulations) in the SQL query itself can lead to decreased performance. Whenever feasible, handle such operations in the application code rather than the database. Use EXISTS Instead of COUNT: When checking for the existence of data in a subquery, use \"EXISTS\" instead of \"COUNT\" to improve query performance. \"EXISTS\" returns as soon as a match is found, while \"COUNT\" scans all rows. Be Mindful of Database Transactions: Wrap related SQL statements in transactions to ensure consistency and reduce database locking and contention issues. However, keep transactions as short as possible to minimize the locking duration. Monitor Query Performance: Regularly monitor the performance of your SQL queries using database profiling and monitoring tools. Identify slow-performing queries and optimize them to improve overall database performance. Conclusion: Writing efficient SQL queries is an art that requires a deep understanding of your database, data, and application requirements. By following the best practices mentioned in this blog post, you can significantly enhance your application\'s database performance, reduce response times.', '2023-08-01', 1),
(21, 22, 38, 'An In-Depth Look at Python\'s Flask Framework', 'images/Flask-in-Python.jpg', '#gamedevelopment', 'Python\'s Flask framework is a powerful and lightweight tool for building web applications and APIs. Known for its simplicity and flexibility, Flask has gained immense popularity among developers worldwide. In this blog post, we will take an in-depth look at Flask, exploring its core features, advantages, and how it empowers developers to create robust and scalable web applications. Understanding Flask: Flask is a micro web framework written in Python. It is designed to be simple and easy to use, making it an excellent choice for both beginners and experienced developers. Flask provides the basics needed to build a web application, giving developers the freedom to add additional libraries as needed, making it highly customizable. Routing and Views: In Flask, routing is handled using decorators. We will delve into how decorators map URL patterns to view functions, allowing developers to define routes and handle user requests. Understanding how views render templates and respond to various HTTP methods (GET, POST, etc.) is essential for building dynamic web pages. Templates and Jinja2: Flask utilizes the Jinja2 template engine to separate the presentation layer from the application logic. We\'ll explore how to create reusable templates, pass data to templates, and use Jinja2\'s powerful features for dynamic content generation. Working with Forms: Handling user input is fundamental for web applications. Flask provides tools for processing and validating form data efficiently. We\'ll examine how to create and validate forms, making the application robust and user-friendly. Database Integration: We\'ll cover Flask\'s integration with various databases, such as SQLite, MySQL, PostgreSQL, and more. Understanding how to perform CRUD operations (Create, Read, Update, Delete) is vital for building data-driven applications. RESTful APIs with Flask: Flask\'s versatility extends to creating RESTful APIs. We\'ll explore how to design and implement APIs to interact with the application programmatically, allowing for integration with other services and applications. Middleware and Extensions: Flask\'s ecosystem offers a plethora of extensions and middleware that enhance its functionality. We\'ll highlight some popular extensions and demonstrate how to integrate them into the Flask application. Handling Authentication and Security: Securing web applications is crucial in the digital age. We\'ll discuss various authentication methods, secure coding practices, and how to protect against common web application vulnerabilities. Testing and Debugging: Testing is vital for ensuring the reliability of web applications. We\'ll explore how to write unit tests for Flask applications and use debugging tools to identify and fix issues during development. Deployment and Scaling: In the final section, we\'ll cover different deployment options for Flask applications, including deploying on shared hosting, cloud platforms, and containerization services like Docker. We\'ll also discuss strategies for scaling Flask applications to handle increased traffic and demand. Conclusion: Python\'s Flask framework is a remarkable tool for building web applications and APIs due to its simplicity, flexibility, and extensive community support. By understanding its core features, developers can harness the full potential of Flask to create robust, scalable, and maintainable web applications. Whether you\'re a beginner exploring web development or an experienced developer seeking a lightweight framework, Flask\'s elegance and power make it an excellent choice for a wide range of projects. So, embrace the world of Flask and embark on an exciting journey of web development with Python.', '2023-08-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(20) NOT NULL,
  `post_id` int(20) DEFAULT NULL,
  `questioner` int(20) DEFAULT NULL,
  `respond_by` int(20) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `stars` int(30) DEFAULT 0,
  `status` int(10) DEFAULT 0,
  `starsgivers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `post_id`, `questioner`, `respond_by`, `question`, `answer`, `stars`, `status`, `starsgivers`) VALUES
(1, 11, 34, 34, 'Contest Location ?', 'Islamabad', 4, 1, '[\"34\",\"35\",\"38\",\"39\"]'),
(3, 11, 37, 35, 'What is Exploring ?', 'Knowing Art', 4, 1, '[\"37\",\"38\",\"39\",\"40\"]'),
(5, 17, 38, 35, 'what is exploring?', 'to find something', 0, 1, ''),
(6, 21, 38, 35, 'What is Flask\'s primary advantage over other web frameworks?', 'Flask\'s primary advantage is its simplicity and flexibility, allowing developers to start with the basics and add additional libraries as needed, making it highly customizable.', 0, 1, NULL),
(7, 21, 39, 35, 'How does Flask handle routing and views?', 'Flask handles routing using decorators, which map URL patterns to view functions, allowing developers to define routes and handle user requests efficiently.', 0, 1, NULL),
(8, 20, 35, 35, 'What is the primary language used to interact with databases?', 'SQL (Structured Query Language) is the primary language used for database interactions.', 0, 1, NULL),
(9, 20, 39, 35, 'How can you improve query performance using indexes?', 'Properly indexed columns can significantly speed up data retrieval in SQL queries.', 0, 1, NULL),
(10, 19, 40, 35, 'What is the primary purpose of responsive web desig', 'To create web applications that adapt to different devices and screen sizes for a seamless user experience.', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `city`, `role`) VALUES
(34, 'MAH', 'muqadas@gmail.com', 'muqadas', '03104455210', 'Islamabad', 'user'),
(35, 'Admin', 'admin@gmail.com', 'admin', '03451245148', 'Islamabad', 'admin'),
(37, 'Salman', 'salman@yahoo.com', 'salman', '03859685123', 'Gujranwala', 'user'),
(38, 'mutahira kousar', 'mu@gmail.com', 'M1234', '068979', 'faisalabad', 'user'),
(39, 'usman', 'us@gmail.com', 'U1234', '0686869', 'karachi', 'user'),
(40, 'majid', 'majid@gmail.com', 'M1234', '0479759479', 'faisalabad', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buying`
--
ALTER TABLE `buying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buying`
--
ALTER TABLE `buying`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
