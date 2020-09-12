import { shallowMount } from '@vue/test-utils';
import ZCard from './ZCard.vue';

describe('ZCard.vue', () => {
  it('renders a component', () => {
    const component = shallowMount(ZCard);
    expect(component.contains('.z-card')).toBe(true);
  });
});
