# Sudoku Plus Validator

The Sudoku Plus Validator is a web application built on Symfony 5 that allows users to validate their Sudoku puzzles and check if they are solved correctly.
This app extends the traditional Sudoku game by adding additional rules and constraints.

## Features

* Validates whether a given Sudoku puzzle is solved correctly according to the Sudoku Plus rules.
* Supports input in a 9x9 grid format.
* Provides feedback on incorrect entries and highlights the mistakes.
* Responsive design for a seamless user experience on different devices.

## Installation

1. Clone the repository:
```shell
git clone https://github.com/kirilcvetkov/sudokuPlusValidator.git sudoku-plus-validator
```
2. Navigate to the project directory:
```shell
cd sudoku-plus-validator
```
3. Copy and update the configuration file.
```shell
cp .env.test .env
```
4. Install the dependencies using Composer:
```shell
composer install
```
5. Start the Symfony development server:
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

## Test Data

For testing purposes, three Sudoku Plus CSV files have been included. These files can be used to validate the Sudoku Plus Validator app. You can find them in the main directory of the app.

- `sudoku9x9.csv`: Contains a valid 9x9 Sudoku Plus puzzle.
- `sudoku16x16.csv`: Contains a valid 16x16 Sudoku Plus puzzle.
- `sudoku16x16-invalid.csv`: Contains an invalid 16x16 Sudoku Plus puzzle with conflicting entries.

To test the app with these files, you can import them using the uploader functionality in the main page of the app. This will load the Sudoku puzzle from the CSV file into the grid for validation.

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
