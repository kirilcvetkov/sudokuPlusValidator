# Sudoku Plus Validator

The Sudoku Plus Validator is a web application built on Symfony 5 that allows users to validate their Sudoku puzzles and check if they are solved correctly.
This app extends the traditional Sudoku game by adding additional rules and constraints.

## Features

* Validates whether a given Sudoku puzzle is solved correctly according to the Sudoku Plus rules.
* Supports input in a 9x9 grid format.
* Provides feedback on incorrect entries and highlights the mistakes.
* Responsive design for a seamless user experience on different devices.

## Installation

Clone the repository:
```shell
git clone https://github.com/your-username/sudoku-plus-validator.git
```
Navigate to the project directory:
```shell
cd sudoku-plus-validator
```

Install the dependencies using Composer:
```shell
composer install
```

Update the database configuration in the .env.local file.

Start the Symfony development server:
```shell
symfony server:start
```

Open your web browser and visit http://localhost:8000 to access the Sudoku Plus Validator app.

## Usage

On the homepage, you will see a file uploader where you can select your Sudoku puzzle CSV file.
Click the "Validate" button to check if your puzzle is solved correctly.
If there are any mistakes, the incorrect entries will be highlighted, and an error message will be displayed.
Review and correct the mistakes in your puzzle based on the feedback provided.
Repeat the validation process until your puzzle is solved correctly.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request to the GitHub repository.

## License

This project is licensed under the MIT License. See the LICENSE file for more information.

## Acknowledgements

Symfony - The PHP framework used for developing this application.
Twig - The templating engine used for rendering views.
Doctrine - The database ORM used for managing database interactions.
Bootstrap - The CSS framework used for styling the application.

## Contact

For any questions or inquiries, please contact kcvetkov@live.com.

## Credits

-  [Kiril Cvetkov](https://github.com/kirilcvetkov)
