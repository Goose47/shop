import {object, string, number, array} from 'yup';

function checkDigits(value) {
  return !(value.toString().includes('.') && value.toString().split('.')[1].length > 2)
}

const schema = object({
  name: string().required('Product name is required'),
  description: string().required('Description is required'),
  price: number().required('Price is required').typeError('Price must be a number').test(
    'test-2-digits', 'Price must have only 2 digits after "."!', checkDigits
  ),
  images: array()
    .nullable()
})

export default schema