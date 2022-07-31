import {object, string, number, array} from 'yup';

// function validateImagesQuantity(images) {
//   if (images) {
//     return images.length <= 3;
//   }
//   return true
// }
//
// function validateImagesExtension(images) {
//   let valid = true
//   const availableExtensions = [
//     'image/jpeg',
//     'image/jpg',
//     'image/png',
//   ]
//   if (images) {
//     images.map(image => {
//       if (!availableExtensions.includes(image.type)) {
//         valid = false;
//       }
//     })
//   }
//
//   return valid
// }

const schema = object({
  name: string().required('Product name is required'),
  description: string().required('Description is required'),
  price: number().required('Price is required').typeError('Price must be a number'),
  images: array()
    .nullable()
    // .test(
    //   'no-more-than-3',
    //   'You have to upload no more than 3 pictures.',
    //   validateImagesQuantity
    // )
    // .test(
    //   'test-extensions',
    //   'You can only upload images.',
    //   validateImagesExtension
    // )
})

export default schema