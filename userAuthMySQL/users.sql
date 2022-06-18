INSERT INTO `Students` (`id`, `full_names`, `country`, `email`, `gender`, `password`) VALUES
(2, 'Nancy Vicky', 'Nigeria', 'nancy@gmail.com', 'Female', 'andy'),
(3, 'Seyi Olufe', 'Nigeria', 'seyi@gmail.com', 'Male', '1234'),
(4, 'Chioma Victoria', 'Nigeria', 'vicky@gmail.com', 'Female', '129323'),
(8, 'Nfon Andrew', 'Cameroon', 'drew@gmail.com', 'Nigeria', 'tatah');





CREATE TABLE `zuriphp`.`students` ( `id` INT(11) NOT NULL , `full_names` VARCHAR(100) NOT NULL , `country` VARCHAR(50) NOT NULL , `email` VARCHAR(100) NOT NULL , `gender` VARCHAR(10) NOT NULL , `dob` DATE NULL DEFAULT NULL , `password` VARCHAR(200) NOT NULL ) ENGINE = InnoDB;
