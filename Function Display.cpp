#include <iostream>
using namespace std;

void Input(); // Function to receive inputs from user
void Calculate(int, int, char); // Function to calculate the result
void Display (int, int,char ,int);

int main() {
    char count;
    do{
        Input();
        cout <<"\n do you want to calculate again?"
               "(Y for yes , N for no)";
        cin>>count;
    }while (count == 'Y' || count =='y');

    return 0;
}

void Input() {
    int i1, i2;
    char choice;

    cout << "\nEnter 2 numbers ";
    cin >> i1 >> i2;

    cout << "\nEnter + to add, - to subtract, * to multiply, / to divide, % for modulus";
    cout << "\nEnter your choice: ";
    cin >> choice;

    Calculate(i1, i2, choice);
}

void Calculate(int a, int b, char c) {
    int result;

    if (c == '+') {
        cout << a << "+" << b << "=" << (a+b);
        result = (a+b);
    }
    else if (c == '-') {
        cout << a << "-" << b << "=" << (a-b);
        result = (a-b);
    }
    else if (c == '*') {
        cout << a << "*" << b << "=" << (a*b);
        result = (a*b);
    }

    else if (c == '/') {
        if (b != 0) {
            cout << a << "/" << b << "=" << (a/b);
            result = (a/b);
        }
        else {
            cout << "\nDivision by zero is not allowed";
        }
    }

    else if (c == '%')
    {
        cout << a << "%" << b << "=" << (a%b);
        result = (a%b);
    }

    Display(a, b, c, result);
}

void Display(int a, int b, char c, int result) {
    cout << endl  << "a " << c << " " << b << " = " << result << endl;
}
