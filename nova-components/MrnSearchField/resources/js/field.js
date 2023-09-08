import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-mrn-search-field', IndexField)
  app.component('detail-mrn-search-field', DetailField)
  app.component('form-mrn-search-field', FormField)
})
