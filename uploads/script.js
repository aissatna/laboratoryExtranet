console.clear();
/*var dog ={
    name : "choupete",
    color : "white",
    age:4,
    setAge : function (NewAge) {
        this.age = NewAge;

    }

}
dog.setAge(20)
console.log(dog.age);
*/
console.clear();
function Dog(name,color,age) {
    this.name=name;
    this.color = color;
    this.age =age;
}
var caniche = new Dog("choupette","white",5);
console.log(caniche);