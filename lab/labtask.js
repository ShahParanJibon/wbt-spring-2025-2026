//Problem-1

let a = 5;
let b = 10;
let temp;
console.log("Previous value:");

console.log("a=", a, "b=", b);

temp = a;
a = b;
b = temp;


console.log("New Value");

console.log("a=", a, "b=", b);
console.log();


//Problem-2

function square(n) {
  return n * n;
}

for (let i = 1; i <= 10; i++) {
  console.log("Square of", i, "=", square(i));
}

console.log();


//Problem-3

let arr = [12, 4, 7, 9, 23, 36];

let largeNum = arr[0];

for (let i = 1; i < arr.length; i++) {
  if (arr[i] > largeNum) {
    largeNum = arr[i];
  }
}

console.log("Largest number:", largeNum);