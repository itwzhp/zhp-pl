import { shallowMount } from '@vue/test-utils';
import ZForm from './ZForm.vue';

describe('ZForm.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZForm);
    expect(component.get('.z-form'));
  });
});
