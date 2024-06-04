#include <iostream>

using namespace std;
int main(){

char choice;
    cout<<"Enter A,B,C: "<<endl;
        
        cin>>choice;
switch (choice)
{
case 'A': 
    cout<< "You entered A. In"<<endl;
        break;

case 'B':
    cout <<"You entered B. In";
        break;  

case 'C':
    cout<< "You entered C. In";
            break; 
default: 
    cout<< "You did not enter A, B, or C! In";
}

}
