#include <iostream>
#include <cstdlib>
using namespace std;

void DisplayArray(int [], int);
int FindLarge(int [],int); //Changed the return type to from void to int: Void doesn't return  any value
int FindSmall(int [], int);//Changed the return type to from void to int: Void doesn't return  any value
int ArrayTotal(int [], int);

int main() {

    int x[10], total,small, large; //Added small and large variables
    srand(time(NULL));

    for (int i = 0; i<10; i++)
            x[i] = rand()%100;

    DisplayArray(x,10);
    //Used small and large variables set equal to
    //FindSmall and FindLarge function
    large = FindLarge(x,10);
    small = FindSmall(x,10);
    total=ArrayTotal (x,10);
    //Display the smallest and largest since we want to display in main;
    cout<<"\nSmallest in the array = "<<small<<endl;
    cout <<"\nLargest in the array = "<< large <<endl;
    cout<<total;


    cout<<"\nArray Total";

        return 0;

}

void DisplayArray(int a [], int s){
for (int i = 0; i < s; i++)
    cout<<a[i]<<endl;
}
//Since we changed the prototype (look back at line 6 and 7)
//We have to change this as well to match the prototype
int FindLarge(int a[],int s){
    int large = a[0];
    for (int i = 0; i<s; i++){
        if(a[i]>large);
    }
    return large; //Returning the biggest  number
   // cout <<"\nLargest in the array = "<< large <<endl;
}
int FindSmall(int a[], int s){
    int small = a[0];
    for (int i = 0; i < s; i++) {
        if (a[i] < small)
            small = a[i];
    }

    return small;//Returning the smallest number
    //cout<<"\nSmallest in the array = "<<small<<endl;
    }
int ArrayTotal(int a[], int s){
    int t = 0;
    for (int i = 0; 1 <s; i++)
        t+= a[i];
    return t; // returning the array
}
