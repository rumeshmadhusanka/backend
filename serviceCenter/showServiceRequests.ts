let row="<tr>\n" +
    "            <td>RequestId</td>\n" +
    "            <td>ServiceId</td>\n" +
    "            <td>Description</td>\n" +
    "            <td>Location</td>\n" +
    "            <td>Status</td>\n" +
    "            <td>Requested time</td>\n" +
    "            <td>Action</td>\n" +
    "        </tr>";
function getFormData(status:string) {
    $.ajax({url:"getServiceRequests.php",method:"GET",data:{status:status}}).then(function (data) {
        Iterator
    })
}
class Iterator<T>{
    private readonly collection:T[];
    private index:number;
    public constructor(collection: T[]) {
        this.collection = collection;
        this.index=0;
    }
    public next(){
        let current=this.collection[this.index];
        this.index+=1;
        return current;
    }
}
// let test:string[]=[];
// test.push("buyxvgu","cfdc","crfvc","nij","sct");
// let i= new Iterator(test);
// console.log(i.next());
// console.log(i.next());
// console.log(i.next());
// console.log(i.next());
// console.log(i.next());
// console.log(i.next());
// console.log(i.next());
