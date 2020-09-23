import { shallowMount } from '@vue/test-utils';
import ZFormField from './ZFormField.vue';

describe('ZFormField.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZFormField);
    expect(component.get('.z-form-field'));
  });
});
