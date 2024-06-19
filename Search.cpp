#include <iostream>
#include <cstdlib>
using namespace std;

void DisplayArray(int [], int);
int Search(int [],int,int);


int Search(int [],int,int);

int main() {

    int x[10], search, found;
    srand(time(NULL));

    for (int i = 0; i<10; i++)
            x[i] = rand()%100;
        
        DisplayArray(x,10);
        cout<<"\nEnter a number to see if it's in the array: ";
        cin >> search;
        found = Search(x,10,search);
        if (found == 1){
            cout << search<< " was found";
        }
        else
            cout<< search << "was not found ;(";
        

            
}
void DisplayArray(int a [], int s){
for (int i = 0; i < s; i++)
    cout<<a[i]<<endl;

}

int Search(int a[],int s,int item){
    int found = 0;
    for (int i = 0; i < s; i++)
    {
        if (a[i]==item)
            found=1;
    }

}