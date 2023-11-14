export default function validate(val, element) {
    element.text('');
    if(val == ''){
        element.text('Please enter a value!');
        return;
    }
    if (isNaN(val)){
        element.text("Please enter a numeric value!");
        return;
    }
}
