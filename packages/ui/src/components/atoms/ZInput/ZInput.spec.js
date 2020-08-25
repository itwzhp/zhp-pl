import { shallowMount } from '@vue/test-utils';
import ZInput from './ZInput.vue';

describe('ZInput.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZInput);
    expect(component.contains('.z-input')).toBe(true);
  });
});
