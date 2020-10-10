import { shallowMount } from '@vue/test-utils';
import ZDatePicker from './ZDatePicker.vue';

describe('ZDatePicker.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZDatePicker);
    expect(component.get('.z-date-picker'));
  });
});
