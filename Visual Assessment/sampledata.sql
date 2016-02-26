-- phpMyAdmin SQL Dump
-- version 4.4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 26, 2016 at 09:37 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gibbon_dev_core`
--

--
-- Dumping data for table `visualAssessmentAttainment`
--

INSERT INTO `visualAssessmentAttainment` (`visualAssessmentAttainmentID`, `visualAssessmentTermID`, `gibbonPersonID`, `attainment`, `timestamp`) VALUES
(00000000000001, 000000000001, 0000001196, '2', '2016-02-16 23:38:53'),
(00000000000002, 000000000018, 0000001196, '2', '2016-02-16 23:38:53'),
(00000000000003, 000000000012, 0000001196, '3', '2016-02-16 23:38:53'),
(00000000000004, 000000000015, 0000001196, '2', '2016-02-16 23:38:53'),
(00000000000005, 000000000019, 0000001196, '1', '2016-02-16 23:38:53'),
(00000000000006, 000000000005, 0000001196, '1', '2016-02-17 00:35:55'),
(00000000000007, 000000000170, 0000001196, '1', '2016-02-17 00:36:18'),
(00000000000008, 000000000104, 0000001196, '2', '2016-02-17 00:37:08'),
(00000000000009, 000000000105, 0000001196, '1', '2016-02-17 00:37:08'),
(00000000000010, 000000000126, 0000001196, '1', '2016-02-17 00:37:08');

--
-- Dumping data for table `visualAssessmentGuide`
--

INSERT INTO `visualAssessmentGuide` (`visualAssessmentGuideID`, `name`, `category`, `description`, `active`, `scope`, `gibbonDepartmentID`, `gibbonYearGroupIDList`, `gibbonPersonIDCreator`) VALUES
(00000001, 'Information & Communication Technology', '', 'Year 7-9 ICT Course Overview', 'Y', 'Learning Area', 0017, '001,002,003', 00000001);

--
-- Dumping data for table `visualAssessmentTerm`
--

INSERT INTO `visualAssessmentTerm` (`visualAssessmentTermID`, `visualAssessmentGuideID`, `term`, `description`, `weight`, `visualAssessmentTermIDParent`) VALUES
(00000000000001, 0000000001, 'ICT enabled', 'Demonstrates skill and speed in operating a computer, using the Internet and engaging with technology in general. Is quick to internalise new skills and concepts in relation to using ICT, and does so willingly as needed. Enjoys using technology to get work done.', NULL, NULL),
(00000000000002, 0000000001, 'hacking & making', 'Sees technological objects as systems made of components, which can be investigated for learning. Is willing and generally able to programme, teardown, investigate and rebuild technological artifacts.', NULL, NULL),
(00000000000011, 0000000001, 'presentation', '', 60, 00000000000166),
(00000000000007, 0000000001, 'sharing & respecting', 'Understands and acts according to copyright law. Uses Creative Commons licensing, and attribution, to build on the work of others, and share own work to a wider audience.', NULL, NULL),
(00000000000006, 0000000001, 'tech sensitive', 'Understands technology as a broad area including all man made artefacts and ideas, and grasps the key importance technology has had on human development and survival as a species. Uses technology in a sensitive fashion, showing concern for its implications, origin or meaning.', NULL, NULL),
(00000000000005, 0000000001, 'media savvy', 'Media impressions are seen as representations of reality, and the nature of that representation is questioned and sometimes critiqued. Media productions generally use consideration of purpose and audience in order to create a form that is fit for purpose and communicates clearly.', NULL, NULL),
(00000000000004, 0000000001, 'problem solving', 'When faced with a problem, student draws on a repertoire of strategies, and is often able to make progress without relying on the teacher.', NULL, NULL),
(00000000000003, 0000000001, 'digitally positive', 'Aware of the impact of ICT usage on self, others and environment. Makes conscious decisions to generally use ICT in a positive fashion. Little negative ICT usage in evidence.', NULL, NULL),
(00000000000012, 0000000001, 'password', 'A secret key or phrase needed to access a digital resource.', 60, 00000000000018),
(00000000000013, 0000000001, 'CLI', 'Command Line Interface - the traditional, text-only way to interface with and control computers.', 30, 00000000000165),
(00000000000014, 0000000001, 'GUI', 'Graphical User Interface - the more modern, graphic enhanced way to interface with and control computers.', 30, 00000000000165),
(00000000000015, 0000000001, 'SPAM', 'Unwanted bulk communications, including email, comments and phone calls. ', 40, 00000000000018),
(00000000000016, 0000000001, 'Scratch', 'Block based programming language for learning programming.', 40, 00000000000020),
(00000000000017, 0000000001, 'embed', 'Taking HTML code offered by one website and using it to incorporate content into another site.', 50, 00000000000163),
(00000000000018, 0000000001, 'security', 'How computers can be attacked and defended.', 70, 00000000000001),
(00000000000019, 0000000001, 'scam', 'Tricking someone into giving up something they don''t want to give up.', 30, 00000000000018),
(00000000000020, 0000000001, 'programming', 'Creating software that runs on a computer and offers certain functionality.', 50, 00000000000001),
(00000000000021, 0000000001, 'tcp/ip', 'Transmission Control Protocal/Internet Protocol: the rules that describe the functioning of the Internet.', 10, 00000000000035),
(00000000000022, 0000000001, 'logical operator', 'Low level electronic circuit used to construct computer systems.', 10, 00000000000165),
(00000000000023, 0000000001, 'word processor', '', 60, 00000000000166),
(00000000000024, 0000000001, 'loop', 'Programming structure that repeats operations multiple times.', 20, 00000000000020),
(00000000000025, 0000000001, 'typing', 'Using a physical or virtual keyboard to input text into a computer.', 30, 00000000000001),
(00000000000026, 0000000001, 'phishing', 'Using alarmist emails to lure victims to a fake website to steal their personal data.', 30, 00000000000018),
(00000000000027, 0000000001, 'email', '', 40, 00000000000166),
(00000000000028, 0000000001, 'Hz/GHz', 'Hertz/Giga Hertz: measures of speed, in terms of cycles per second.', 15, 00000000000165),
(00000000000029, 0000000001, 'kB/MB/GB/TB', 'Kilo/Meg/Giga/Tera Bytes: measures of computer storage, based on multiples of 1024 bytes.', 25, 00000000000165),
(00000000000030, 0000000001, 'bits/Bytes', 'Bit: a single binary digit (e.g. a 0 or a 1). Byte: a collection of 8 bits.', 30, 00000000000165),
(00000000000031, 0000000001, 'Drupal', 'A popular content management system, used to build complex websites..', 15, 00000000000165),
(00000000000032, 0000000001, 'spreadsheet', '', 50, 00000000000166),
(00000000000033, 0000000001, 'malware', 'Software that has malicious, negative functionality, including viruses, Trojans, keyloggers, etc.', 30, 00000000000018),
(00000000000034, 0000000001, 'PHP', 'Text based programming language used to build dynamic, server-side web content.', 20, 00000000000020),
(00000000000035, 0000000001, 'the Internet', 'The global network of computer networks that powers apps such as the Web, email, gaming, etc.', 80, 00000000000001),
(00000000000036, 0000000001, 'CSS', 'Cascading Style Sheets: a powerful, flexible way to present/style to HTML.', 30, 00000000000163),
(00000000000037, 0000000001, 'HTML', 'HyperText Markup Language: the language used to describe the content of a web page.', 30, 00000000000163),
(00000000000038, 0000000001, 'WordPress', 'A popular content management system, used to build websites efficiently.', 40, 00000000000163),
(00000000000039, 0000000001, 'JavaScript', 'A client-side (e.g. browser) scripting language for adding dynamic elements to a website.', 20, 00000000000163),
(00000000000040, 0000000001, 'browser', '', 30, 00000000000166),
(00000000000041, 0000000001, 'docx', 'The default file format of Microsoft Word.', 10, 00000000000043),
(00000000000042, 0000000001, 'data type', 'Variations in how data are stored, including characters, strings, integers, floats and Booleans.', 15, 00000000000165),
(00000000000043, 0000000001, 'file types', 'Representation of different types of information, and different approaches to storage, within a computer file system.', 15, 00000000000001),
(00000000000044, 0000000001, 'instructions', 'Individual elements of a programming language that tell a computer what to do.', 25, 00000000000020),
(00000000000045, 0000000001, 'Internet vs WWW', 'The Internet, as the network of communication, as opposed to the World Wide Web as one application that uses the Internet to communicate.', 30, 00000000000035),
(00000000000046, 0000000001, 'network of networks', 'A structure of the Internet, as a global network that links together other local and wide area networks.', 15, 00000000000035),
(00000000000047, 0000000001, 'packet switching', 'Network communication based on splitting data into small chunks, and moving them around the network individually.', 15, 00000000000035),
(00000000000048, 0000000001, 'pdf', 'A file format used to store documents in a non-editable form.', 10, 00000000000043),
(00000000000049, 0000000001, 'png', 'A file format for storing images with lossless compression, resulting in high quality with moderate file sizes. Supports transparency, but not layers.', 10, 00000000000043),
(00000000000050, 0000000001, 'file conversion', 'Converting a file from one format to another.', 25, 00000000000043),
(00000000000051, 0000000001, 'xlsx', 'The default file format of Microsoft Excel.', 10, 00000000000043),
(00000000000052, 0000000001, 'csv', 'A file format using comma separated values to store data in a simple grid.', 10, 00000000000043),
(00000000000053, 0000000001, 'jpg', 'A file format for storing images with lossy compression, resulting in moderate quality with small-moderate file sizes. Lacks support for  transparency and layers.', 10, 00000000000043),
(00000000000054, 0000000001, 'mp4', 'A file format for storing compressed video, using a variety of codecs.', 10, 00000000000043),
(00000000000055, 0000000001, 'mp3', 'A file format for storing compressed audio at variable quality levels.', 10, 00000000000043),
(00000000000056, 0000000001, 'mobile', '', 20, 00000000000167),
(00000000000057, 0000000001, 'tablet', '', 20, 00000000000167),
(00000000000058, 0000000001, 'laptop', '', 20, 00000000000167),
(00000000000059, 0000000001, 'desktop', '', 20, 00000000000167),
(00000000000060, 0000000001, 'smartphone', '', 20, 00000000000167),
(00000000000061, 0000000001, 'robotics', 'Constructing and programming computer controlled mechanical objects.', 30, 00000000000160),
(00000000000062, 0000000001, '3D printing', 'Turning 3D digital designs into real objects through additive manufacturing.', 15, 00000000000160),
(00000000000063, 0000000001, 'software', 'Using, combining and tweaking existing programming code in novel ways, to solve problems.', 40, 00000000000161),
(00000000000064, 0000000001, 'operating system', 'Using a computer''s operating software (e.g. Mac OS X) to get things done.', 50, 00000000000166),
(00000000000065, 0000000001, 'technical vocabulary', 'Using appropriate, well known, subject-specific names for objects and processes.', 60, 00000000000068),
(00000000000066, 0000000001, 'sewing', 'Using needle and thread to join or alter objects.', 20, 00000000000160),
(00000000000067, 0000000001, 'hardware', 'Using, combining and tweaking existing hardware in novel ways, to solve problems.', 50, 00000000000161),
(00000000000068, 0000000001, 'teardown & rebuild', 'Carefully dismantaling an object, understanding how it works, and then returning it to working order.', 80, 00000000000002),
(00000000000069, 0000000001, 'components', 'The various parts that make up a larger system.', 50, 00000000000068),
(00000000000070, 0000000001, 'hand tools', 'Basic, hand operated tools, including screw drivers, Allen keys, pliers and soldering irons.', 50, 00000000000160),
(00000000000162, 0000000001, 'conditional', 'Programming structure that makes a decision or responds to an input.', 30, 00000000000020),
(00000000000072, 0000000001, 'using documentation', 'Reading and applying knowledge from manuals, forums, wikis and diagrams.', 50, 00000000000068),
(00000000000073, 0000000001, 'fabrication', 'Constructing objects from resistant materials.', 50, 00000000000160),
(00000000000074, 0000000001, 'privacy', 'The ability and freedom to maintain control over one''s personal information.', 70, 00000000000085),
(00000000000075, 0000000001, 'social networking', '', 40, 00000000000172),
(00000000000076, 0000000001, 'notifications', '', 30, 00000000000172),
(00000000000077, 0000000001, 'relationships', '', 30, 00000000000172),
(00000000000078, 0000000001, 'identity', 'The various ways we conceive of and portray ourselves online', 70, 00000000000085),
(00000000000079, 0000000001, 'focus', '', 80, 00000000000172),
(00000000000080, 0000000001, 'participation', 'The online environments we choose to use, and the ways, both positive and negative, we use them.', 70, 00000000000085),
(00000000000081, 0000000001, 'IRL', '', 50, 00000000000172),
(00000000000082, 0000000001, 'personal safety', '', 50, 00000000000172),
(00000000000083, 0000000001, 'netiquette', '', 40, 00000000000172),
(00000000000084, 0000000001, 'credibility', 'The degree to which people know and trust us online: our digital reputation.', 70, 00000000000085),
(00000000000085, 0000000001, 'digital citizenship', 'Conducting ourselves, and staying safe, as users and builders of online worlds.', 80, 00000000000003),
(00000000000086, 0000000001, 'troubleshooting', 'Finding and implementing solutions to non-trivial problems.', 60, 00000000000004),
(00000000000087, 0000000001, 'analysing', '', 40, 00000000000168),
(00000000000088, 0000000001, 'evaluating', '', 40, 00000000000168),
(00000000000169, 0000000001, 'communicating', 'Deliberately using form to convey a message to an audience for a specific purpose.', 60, 00000000000005),
(00000000000090, 0000000001, 'genuine problem', 'Real world challenges that require a solution.', 70, 00000000000004),
(00000000000091, 0000000001, 'collaboration', 'Working with others in order to solve problems and create solutions.', 55, 00000000000092),
(00000000000092, 0000000001, 'gumption', 'Energy and spirit in the face of challenging circumstances.', 30, 00000000000004),
(00000000000093, 0000000001, 'prediction', '', 40, 00000000000168),
(00000000000094, 0000000001, 'individual', 'Working independently to solve problems and create solutions.', 55, 00000000000092),
(00000000000096, 0000000001, 'leadership', 'Taking the initiative in a collaborative setting, and helping others work towards a solution together.', 35, 00000000000092),
(00000000000097, 0000000001, 'transdisciplinary', '', 40, 00000000000168),
(00000000000098, 0000000001, 'decision making', 'Determining the best course of action, given past, current and possible future circumstances.', 30, 00000000000092),
(00000000000099, 0000000001, 'productivity', 'Getting things done, efficiently and to a high level of quality, in a timely fashion.', 60, 00000000000092),
(00000000000100, 0000000001, 'diagnosis', '', 60, 00000000000168),
(00000000000101, 0000000001, 'cause & effect', '', 40, 00000000000168),
(00000000000102, 0000000001, 'client', 'A individual or organisation for whom your work on a specific project, providing ICT support and solutions.', 50, 00000000000090),
(00000000000103, 0000000001, 'creativity', 'Approaching problems by thinking and acting in ways that are personally new and challenging.', 90, 00000000000004),
(00000000000104, 0000000001, 'audio editing', '', 20, 00000000000170),
(00000000000105, 0000000001, 'movie editing', '', 30, 00000000000170),
(00000000000106, 0000000001, 'citation', 'Formally giving credit to the sources and influences drawn upon in your work.', 20, 00000000000112),
(00000000000107, 0000000001, 'representation', '', 40, 00000000000169),
(00000000000108, 0000000001, 'critical thinking', 'In depth consideration of the merits of sources in research, rather than simply accepting things at face value.', 70, 00000000000112),
(00000000000109, 0000000001, 'quality', '', 40, 00000000000171),
(00000000000110, 0000000001, 'search terms', 'Using and refining a range of words and phrases to locate documents online via a search engine.', 30, 00000000000112),
(00000000000111, 0000000001, 'genre', '', 40, 00000000000169),
(00000000000112, 0000000001, 'research', 'Searching and making use of a body of existing knowledge.', 45, 00000000000005),
(00000000000113, 0000000001, 'multiple sources', 'Relying on a range of sources of different types in conducting research.', 30, 00000000000112),
(00000000000114, 0000000001, 'audience', '', 50, 00000000000169),
(00000000000115, 0000000001, 'purpose', '', 50, 00000000000169),
(00000000000116, 0000000001, 'multimedia', '', 60, 00000000000170),
(00000000000117, 0000000001, 'digital portfolio', '', 60, 00000000000169),
(00000000000118, 0000000001, 'evaluate', 'Consider and compare the strengths and weakness of a variety of sources.', 40, 00000000000112),
(00000000000119, 0000000001, 'information', '', 50, 00000000000171),
(00000000000120, 0000000001, 'refine', 'Taking data and improving its quality by fixing mistakes, removing duplicates, etc.', 30, 00000000000171),
(00000000000121, 0000000001, 'data', '', 30, 00000000000171),
(00000000000122, 0000000001, 'photography', '', 25, 00000000000170),
(00000000000123, 0000000001, 'reflective writing', '', 25, 00000000000169),
(00000000000124, 0000000001, 'subject specific', '', 40, 00000000000169),
(00000000000125, 0000000001, 'narrative', '', 40, 00000000000169),
(00000000000126, 0000000001, 'graphic design', '', 40, 00000000000170),
(00000000000127, 0000000001, 'visualisation', '', 25, 00000000000169),
(00000000000128, 0000000001, 'publishing online', '', 40, 00000000000169),
(00000000000129, 0000000001, 'ICT history', 'Awareness that computers developed as calculating machines, that we huge, slow and expensive, and have improved incrementally over time.', 40, 00000000000131),
(00000000000130, 0000000001, 'tech and you', 'The importance of technology in the life of an individual.', 40, 00000000000006),
(00000000000131, 0000000001, 'human history', 'How we came to be the species we are today, and the role technology played in the great human story.', 60, 00000000000006),
(00000000000132, 0000000001, 'societal change', 'Awareness that scoieties are changed by technology, and that the way things are is not they must be, nor how they used to be.', 30, 00000000000131),
(00000000000133, 0000000001, 'workplace', 'Awareness that technology has and will continue to change the nature of work and careers.', 20, 00000000000131),
(00000000000134, 0000000001, 'balance', 'Making sensible, measured and purposeful use of technology in your own life.', 40, 00000000000130),
(00000000000135, 0000000001, 'ICT vs technology', 'Technology as the sum of all human tools, against ICT, a subset of those tools relating to computers and networks.', 60, 00000000000131),
(00000000000136, 0000000001, 'modern living', 'Awareness of the importance and costs of technology in contemproary society within developed nations.', 40, 00000000000131),
(00000000000137, 0000000001, 'sustainability', 'Appreciating that we live on a planet with finite resources, and purchase and using technology accordingly.', 60, 00000000000130),
(00000000000138, 0000000001, 'being human', 'Awareness of the great human story, our evolutionary background, the importance of technology on our survival and development and what it means to be human.', 80, 00000000000131),
(00000000000139, 0000000001, 'incentive', 'One aim of copyright: to allow authors to sell their work, thus giving motivation to create.', 30, 00000000000154),
(00000000000140, 0000000001, 'attribution', 'Giving credit to those whose materials have been used in a remixed piece of work.', 40, 00000000000144),
(00000000000141, 0000000001, 'knowledge', 'The way our total, share stock of knowledge is impact by sharing (open) and control (closed)', 30, 00000000000154),
(00000000000142, 0000000001, 'remix', 'Taking existing creations and mashing them together to create something new and different.', 40, 00000000000007),
(00000000000143, 0000000001, 'authorship', 'Stating claim as the producer or writer of a piece of work.', 80, 00000000000144),
(00000000000144, 0000000001, 'Creative Commons', 'A global cultural and legal framework for sharing and building knowledge and creativity together. ', 70, 00000000000007),
(00000000000145, 0000000001, 'image', 'Including visual/graphic elements within a remix.', 25, 00000000000142),
(00000000000146, 0000000001, 'video', 'Including moving picture elements within a remix.', 25, 00000000000142),
(00000000000147, 0000000001, 'text', 'Including elements of writing within a remix.', 25, 00000000000142),
(00000000000148, 0000000001, 'music', 'Including rhythmic audio elements within a remix.', 25, 00000000000142),
(00000000000149, 0000000001, 'patent', 'An area of intellectual property dealing with protecting inventions.', 15, 00000000000154),
(00000000000150, 0000000001, 'creativity', 'Innovation and learning, which can be enhanced or decreased by variations in copyright law strength.', 30, 00000000000154),
(00000000000151, 0000000001, 'GNU GPL', 'General Public License, one of the earliest permissions/copyleft licenses, on which Creative Commons was based.', 10, 00000000000144),
(00000000000152, 0000000001, 'libre vs gratis', 'Distinction between something that is free as in freedom, and something that is free as in without cost.', 20, 00000000000144),
(00000000000153, 0000000001, 'search', 'Using specific search engines and strategies to find Creative Commons materials online.', 40, 00000000000144),
(00000000000154, 0000000001, 'copyright law', 'Laws relating to the ownership of idea expression and the right to control and copy.', 50, 00000000000007),
(00000000000155, 0000000001, 'ownership', 'Control of intellectual property, based on authorship, contact or purchase.', 70, 00000000000154),
(00000000000156, 0000000001, 'plagiarism', 'Taking the work of others and presenting it as our own work.', 40, 00000000000007),
(00000000000157, 0000000001, 'fair use', 'Allowance, under copyright law, to use parts of a protected work for education, criticism or art.', 25, 00000000000154),
(00000000000158, 0000000001, 'audio', 'Including sound effects and voice over elements within a remix.', 25, 00000000000142),
(00000000000159, 0000000001, 'the future', 'Understanding that technology is a force of constant change, and considering how the future will be different to the present and the past.', 20, 00000000000130),
(00000000000160, 0000000001, 'making', 'Imagining and fabricating objects from available materials.', 60, 00000000000002),
(00000000000161, 0000000001, 'hacking', 'Finding clever, technical solutions and repurposing existing ICT hardware and software to new purposes.', 60, 00000000000002),
(00000000000163, 0000000001, 'web development', 'Creating sites and applications accessible via the World Wide Web.', 20, 00000000000001),
(00000000000165, 0000000001, 'computer science', 'How computers operate, at the fundamental level of binary logic.', 50, 00000000000001),
(00000000000166, 0000000001, 'using software', 'Using applications to perform a variety of tasks.', 60, 00000000000001),
(00000000000167, 0000000001, 'form factors', 'The various shapes, sizes and types of computers.', 50, 00000000000001),
(00000000000168, 0000000001, 'critical thinking', 'Structured approaches to analyse and solve problems.', 70, 00000000000004),
(00000000000170, 0000000001, 'creating', 'Designing and bringing to life media and cultural artefacts.', 60, 00000000000005),
(00000000000171, 0000000001, 'data processing', 'Turning data into information and then knowledge.', 50, 00000000000005),
(00000000000172, 0000000001, 'using technology', 'Ways in which we apply and make use of digital technology in our lives.', 50, 00000000000003),
(00000000000173, 0000000001, 'gif', 'A file format for storing images with lossy compression, resulting in low quality with small file sizes. Supports animation and low quality transparency, but not layers.', 20, 00000000000043),
(00000000000174, 0000000001, 'learning by failing', 'Failure is an inevitable part of taking risks, and is essential to learning and being creative.', 70, 00000000000002),
(00000000000175, 0000000001, 'requirements', 'A list of outcomes, devised with a client, that a project needs to meet.', 40, 00000000000090),
(00000000000176, 0000000001, 'pitch', 'Presenting a solution to a client with the aim that they adopt your proposal.', 50, 00000000000090),
(00000000000177, 0000000001, 'knowledge', '', 50, 00000000000171),
(00000000000178, 0000000001, 'pixel', 'A single light within a grid of lights that can be switched to display images.', 40, 00000000000165);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
